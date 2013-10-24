<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Core\Controller\ActionController;

/**
 * Controlador que gerencia os posts
 * 
 * @category Application
 * @package Controller
 * @author  Elton Minetto <eminetto@coderockr.com>
 */
class IndexController extends ActionController
{
    /**
     * Mostra os posts cadastrados
     * @return void
     */
    public function indexAction()
    {        
        return new ViewModel(array(
            'posts' => $this->getTable('Application\Model\Post')
                            ->fetchAll()
                            ->toArray()
        ));
    }
    
    
    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if ( $id == 0 ) {
            throw new \Exception('Parâmetro obrigatório inválido');
        }
        
        $post = $this->getTable('Application\Model\Post')->get($id)->toArray();
        
        $comments = $this->getTable('Application\Model\Comment')
                        ->fetchAll(null, 'post_id = ' . $post['id'])
                        ->toArray();
        $post['comments'] = $comments;
        
        
        return new ViewModel(compact('post'));
        
    }
}