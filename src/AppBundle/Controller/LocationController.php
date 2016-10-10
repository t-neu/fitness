<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GymLogin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

?>

            <script>
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var accuracy = position.coords.accuracy;
            var speed = position.coords.speed;
            var timestamp = position.timestamp;
            
                if(position.coords.accuracy <= 100){
                        output.innerHTML = "Accuracy within 100";
                }

            }
            </script>
            

<?php
class LocationController extends Controller
{
    /**
     * @Route("/gym")
     */
    public function gymAction()
    {
        $lat = '39.9736184';
        $long = '-74.8824716';
        $accuracy = '20';
        
        $long_h = $long + .0001;
        $long_l = $long - .0001;
        
        //lat conversion for 
        $lat_h = $lat + .0001;
        $lat_l = $lat - .0001;
        
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:GymList');
        
        $query = $repository->createQueryBuilder('p')
        ->select('p.name')
        ->where('p.latitude > :lat_l', 'p.latitude < :lat_h', 'p.longitude > :long_l', 'p.longitude < :long_h')
        ->setParameter('lat_l', $lat_l)
        ->setParameter('lat_h', $lat_h)
        ->setParameter('long_l', $long_l)
        ->setParameter('long_h', $long_h)
        ->getQuery();
        //$query->setMaxResults(1)->getOneOrNullResult();
        $new = $query->getResult();
        $new2 = $new[0]['name'];
        
        $em = $this->get('doctrine')->getManager();
        
        //
        //$user = $this->container->get('security.token_storage')->getToken()->getUser();
        //$id = $user->getId();
        //$otherId = $em->getRepository('AppBundle\UserBundle\Entity\User')->find($id);
        $user = $this->getUser();
        try {
            //setup insertion
            $GymLogin = new GymLogin();
            $GymLogin->setDate(new \DateTime());
            $GymLogin->setUserid($user);

            //prepare the insertion
            //$em = $this->get('doctrine')->getManager();
            $em->persist($GymLogin);
            
            $em->flush();
            $response = 'Check In Was Successful!';
        } catch (Exception $e) {
            $response = 'Unable To Check In!';
        }

        
        return $this->render('AppBundle:Location:gym.html.twig', array(
            'lat' => $lat, 'long' => $long, 'accuracy' => $accuracy, 'new' => $new2, 'response' => $response,
        ));
        
    }

}