<?php 

namespace App\Controllers;
use App\View;
use App\Repositories\RepositoryManager;

class BookingsController
{
public function renterBookings(): void
    {

        $view = new View('pages\bookings');
        $query_addons = ' WHERE b.user_id ='. $_SESSION['USER']->id .';';
       
        
        $bookings = RepositoryManager::getRm()->getBookingRepository()->findRenterBookings($query_addons);

        $view->render([
            'html_title' => 'Mes reservations',
            'announcements' => RepositoryManager::getRm()->getAnnouncementRepository()->findAll(),
            'users' => RepositoryManager::getRm()->getUserRepository()->findAll(),
            'bookings' => $bookings,
        ]);
        }

        public function announcerBookings(): void
        {
            
            $view = new View('pages\announcer-bookings');
            $query_addons = ' WHERE a.owner_id ='. $_SESSION['USER']->id .';';
           
            
            $bookings = RepositoryManager::getRm()->getBookingRepository()->findAnnouncerBookings($query_addons);
    
            $view->render([
                'html_title' => 'Mes reservations',
                'announcements' => RepositoryManager::getRm()->getAnnouncementRepository()->findAll(),
                'users' => RepositoryManager::getRm()->getUserRepository()->findAll(),
                'bookings' => $bookings,
            ]);
        }
}