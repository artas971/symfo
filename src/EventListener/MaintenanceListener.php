<?php

namespace App\EventListener;

use Twig\Environment;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class MaintenanceListener
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    private $maintenance;
    private $twig;
    private $security;
    // ====================================================== //
    // ==================== CONSTRUCTEUR ==================== //
    // ====================================================== //
    public function __construct($maintenance, Environment $twig, Security $security)
    {
        $this->maintenance = $maintenance;
        $this->twig = $twig;
        $this->security = $security;
        // dump("ici");
    }
    // ====================================================== //
    // ====================== LISTENERS ===================== //
    // ====================================================== //
    public function onKernelRequest(RequestEvent $event){
        
        // dd(file_exists($this->maintenance));
        // Si le fichier .maintenance n'existe pas, on laisse passer les gens
        if(!file_exists($this->maintenance)){
            return;
        }
        // Si l'utilisateur est un ADMIN on le laisse passer
        if($this->security->isGranted('ROLE_ADMIN')){
            return;
        }
        // Si la route est maintenance, on laisse passer
        if($event->getRequest()->attributes->get('_route') === 'app_maintenance'){
            return;
        }
        // Sinon on affiche la page maintenance
        $event->setResponse(new Response($this->twig->render('front_maintenance/maintenance.html.twig')));
    }

}
