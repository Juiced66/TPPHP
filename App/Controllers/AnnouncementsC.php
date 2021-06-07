<?php

namespace App\Controllers;
use App\View;
use App\Models\Booking;
use App\Models\Announcement;
use Laminas\Diactoros\ServerRequest;
use App\Models\Announcement_facilities;
use App\Repositories\RepositoryManager;

class AnnouncementsC
{
    public function announcements(): void
    {

        $view = new View('pages\announcements');
        
        $view->render([
            'html_title' => 'Annonces',
            'users' => RepositoryManager::getRm()->getUserRepository()->findAll(),
            'announcements' => RepositoryManager::getRm()->getAnnouncementRepository()->findAll()
        ]);
    }

    public function createAnnouncements(): void
    {

        $view = new View('pages\createannouncement');

        $view->render([
            'html_title' => 'Creer une annonce',
        ]);
    }

    public function myAnnouncements():void 
    {
        $view = new View('pages\my-announcements');
    
            $query_addons = ['WHERE Announcement.owner_id ='.$_SESSION['USER']->id.';'];
            $view->render([
                'html_title' => 'Mes reservations',
                'announcements' => RepositoryManager::getRm()->getAnnouncementRepository()->findAll($query_addons),
                'users' => RepositoryManager::getRm()->getUserRepository()->findAll(),
            ]);
   
}
    public function announcebyid($id): void
    {

        $announce = RepositoryManager::getRm()->getAnnouncementRepository()->findById($id);
        $query_addons = ['join Facility ON Announcement_facilities.facility_id = Facility.id','where Announcement_facilities.announcement_id= :pageid;'];
        $addon_data = ['pageid' => $id];

        if (
            is_null($announce)
        ) {
            View::render404();
            return;
        }

        $view = new View('pages\detailid');
        $view->render([
            'html_title' => $announce->title,
            'users' => RepositoryManager::getRm()->getUserRepository()->findAll(),
            'Announcement_facilities' => RepositoryManager::getRm()->getAnnouncement_facilitiesRepository()->findAll($query_addons, $addon_data),
            'announce' => $announce
        ]);
    }
    public function rent(ServerRequest $request, int $id)
    {
        
        $post_data = $request->getParsedBody();
 
        $bk = new Booking();
 
        $bk->begin_at = $post_data['begin_at'];
        $bk->end_at = $post_data['end_at'];
        $bk->user_id = $_SESSION['USER']->id;
        $bk->announcement_id = $id;
        $success = RepositoryManager::getRm()->getBookingRepository()->create($bk);
 
        // if (!$success) {
        //     header('Location: /detail/' . $id);
 
        //     die();
        // }
 
        header('Location: /bookings');
    }

    public function createAnnouncement(ServerRequest $request){
     
        $post_data = $request->getParsedBody();
       

        
        $an = new Announcement();
        var_dump($an);
        $an->title = $post_data['title'];
        $an->owner_id = $_SESSION['USER']->id;
        $an->city = $post_data['city'];
        $an->country = $post_data['country'];
        $an->price = intval($post_data['price']);
        $an->nb_persons = intval($post_data['nb_persons']);
        $an->description = $post_data['description'];
        $an->rent_type = intval($post_data['rent_type']);
        if(isset($post_data['okPet'])):
            $facility = new Announcement_facilities;
            $facility->facility_id = intval($post_data['okPet']);
            $facility->announcement_id = intval($an->id);
        endif;
        if(isset($post_data['box-internet'])):
            $facility = new Announcement_facilities;
            $facility->facility_id = intval($post_data['box-internet']);
            $facility->announcement_id = intval($an->id);
        endif;
        if(isset($post_data['cafetière'])):
            $facility = new Announcement_facilities;
            $facility->facility_id = intval($post_data['cafetière']);
            $facility->announcement_id = intval($an->id);
    endif;
        if(isset($post_data['washing-machine'])):
            $facility = new Announcement_facilities;
            $facility->facility_id = intval($post_data['washing-machine']);
            $facility->announcement_id = intval($an->id);
    endif;
        if(isset($post_data['grille-pain'])):
            $facility = new Announcement_facilities;
            $facility->facility_id = intval($post_data['grille-pain']);
            $facility->announcement_id = intval($an->id);
    endif;
        if(isset($post_data['micro-onde'])):
            $facility = new Announcement_facilities;
            $facility->facility_id = intval($post_data['micro-onde']);
            $facility->announcement_id = intval($an->id);
    endif;

        $success = RepositoryManager::getRm()->getAnnouncementRepository()->create($an);
        if (!$success) {
            header('Location: /create-announcement');
            die();
        }
        header('Location: /');

    
    }
    public function announcementCreator(): void
    {

        $view = new View('pages\create-announcement');

        $view->render([
            'html_title' => 'Créér une annonce'
        ]);
    }
}
