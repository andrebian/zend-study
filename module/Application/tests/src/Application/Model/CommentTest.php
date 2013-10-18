<?php

namespace Application\Model;

use Core\Test\TestCase;
use Application\Model\Comment;
use Application\Model\Post;

class CommentTest extends TestCase
{
    public function testGetInputFilter()
    {
        $comment = new Comment();
       
        $if = $comment->getInputFilter();
        
        $this->assertInstanceOf("Zend\InputFilter\InputFilter", $if);
        
        return $if;
    }
    
    
    
    /**
     * @depends testGetInputFilter
     * @param type $if
     */
    public function testIfHadAllNecessaryFields( $if )
    {
        $this->assertEquals(7, $if->count());
        
        $this->assertTrue($if->has('id'));
        $this->assertTrue($if->has('post_id'));
        $this->assertTrue($if->has('description'));
        $this->assertTrue($if->has('name'));
        $this->assertTrue($if->has('email'));
        $this->assertTrue($if->has('webpage'));
        $this->assertTrue($if->has('comment_date'));
    }
    
    /**
     * @expectedException Core\Model\EntityException
     */
    public function testInputFilterInvalido()
    {
        //testa se os filtros estão funcionando
        $comment = new Comment();
        //title só pode ter 100 caracteres
        $comment->email = 'Lorem Ipsum é simplesmente uma simulação de texto da indústria 
        tipográfica e de impressos. Lorem Ipsum é simplesmente uma simulação de texto 
        da indústria tipográfica e de impressos';
    }
    
    
    public function testInsert()
    {   
        $post = $this->addPost();
        $this->assertEquals('Teste', $post['description']);
        
        $comment = $this->addComment( $post['id'] );

        $saved = $this->getTable('Application\Model\Comment')->save($comment);

        $this->assertEquals('Teste de cadastro', $saved->description);
        //testa o auto increment da chave primária
        $this->assertEquals(1, $saved->id);
    }
    
    
    
    private function addPost()
    {
        $post = new Post();
        $post->title = 'Apple compra a Coderockr';
        $post->description = 'Teste<br> ';
        $post->post_date = date('Y-m-d H:i:s');
        
        $table = $this->getTable('Application\Model\Post')->save($post);
        $tableData = $table->getData();
        
        return $tableData;
    }
    
    private function addComment( $postId )
    {
        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->description = 'Teste de cadastro</b><br> ';
        $comment->name = 'Andre Cardoso';
        $comment->email = 'andre@redsuns.com.br';
        $comment->webpage = 'http://andrebian.com';
        $comment->comment_date = date('Y-m-d H:i:s');

        return $comment;
    }
}
