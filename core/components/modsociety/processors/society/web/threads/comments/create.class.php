<?php

/*
    Создаем новый комментарий.
    Комментарий добавляется только вместе с веткой. Если ветки нет, то ее надо создать
*/

require_once dirname(dirname(__FILE__)) . '/update.class.php';


class modSocietyWebThreadsCommentsCreateProcessor extends modSocietyWebThreadsUpdateProcessor{
    
    public $CommentClassKey = "SocietyComment";
    
    protected $parent = null;
    
    public function initialize(){
        
        if(!$this->getProperty('text')){
            return "Нельзя сохранить пустой комментарий";
        } 
        
        /*
            Если был указан ID родительского комментария, то проверяем наличие родительского
            объекта. Если его нет, возвращаем ошибку.
            Если был получен родительский комментарий, то просто копируем основные данные из него
        */
        
        if($parent_id = (int)$this->getProperty('parent')){
            if(!$this->parent = $this->modx->getObject($this->CommentClassKey, $parent_id)){
                return "Не был получен родительский комментарий";
            }
            
            // else
            $this->setProperties(array(
                "thread_id" => $this->parent->get('thread_id'),
            )); 
        }
        
        
        // Sanitize post data
        $this->unsetProperty('ip');
        $this->unsetProperty('createdon');
        $this->unsetProperty('createdby');
        $this->unsetProperty('editedon');
        $this->unsetProperty('editedby');
        $this->unsetProperty('deletedon');
        $this->unsetProperty('deletedby');
        $this->unsetProperty('comments_count');
        $this->unsetProperty('properties');
          
        return parent::initialize();
    }
     
    
    public function beforeSave(){
        
        /*
            Создаем новый объект комментария
        */
        $comment = $this->modx->newObject('SocietyComment', $this->getProperties());
        
        $this->object->addMany($comment);
        
        if(!$comment->save()){
            return "Can not save comment";
        }
        
        // else add comment count
        $this->object->set('comments_count', $this->object->get('comments_count') + 1);
        
        return parent::beforeSave();
    }
    
}

return 'modSocietyWebThreadsCommentsCreateProcessor';