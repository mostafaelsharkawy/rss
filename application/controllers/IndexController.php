<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Link();
        
    }

    public function indexAction()
    {
        // action body
        $links=$this->model->listLinks();
        $this->view->links = $links;
        $link=$links[0]["link"];
        $feed = Zend_Feed_Reader::import($link);
        $data = array(
            'title' => $feed->getTitle(),
            'link' => $feed->getLink(),
            'dateModified' => $feed->getDateModified(),
            'description' => $feed->getDescription(),
            'language' => $feed->getLanguage(),
            'entries' => array(),
        );
        foreach ($feed as $entry) {
            $edata = array(
                'title' => $entry->getTitle(),
                'description' => $entry->getDescription(),
                'dateModified' => $entry->getDateModified(),
                'authors' => $entry->getAuthors(),
                'link' => $entry->getLink(),
                'content' => $entry->getContent()
            );
            $data['entries'][] = $edata;
        }
        $this->view->data = $data;
        
    }

    public function showAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        $link = $this->model->getLinksById($id);
        $link=$link[0]["link"];
//        $this->view->link = $link;
//        $channel = new Zend_Feed_Rss($link);
//        $this->view->channeltitle = $channel->title();
//        $this->view->channel = $channel;
        
        $this->view->link = $link;
        $feed = Zend_Feed_Reader::import($link);
        $data = array(
            'title' => $feed->getTitle(),
            'link' => $feed->getLink(),
            'dateModified' => $feed->getDateModified(),
            'description' => $feed->getDescription(),
            'language' => $feed->getLanguage(),
            'entries' => array(),
        );
        foreach ($feed as $entry) {
            $edata = array(
                'title' => $entry->getTitle(),
                'description' => $entry->getDescription(),
                'dateModified' => $entry->getDateModified(),
                'authors' => $entry->getAuthors(),
                'link' => $entry->getLink(),
                'content' => $entry->getContent()
            );
            $data['entries'][] = $edata;
        }
        $this->view->data = $data;
    }

    public function addAction()
    {
        // action body
        $form = new Application_Form_Add();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->getRequest()->getParams())) {
                $data = $form->getValues();
                $link=trim($data["link"]);
//                        $this->view->data = $data;
                $this->model->addLink($link);
            }
        }
        $this->view->form = $form;
        $this->view->links = $this->model->listLinks();
    }


}


