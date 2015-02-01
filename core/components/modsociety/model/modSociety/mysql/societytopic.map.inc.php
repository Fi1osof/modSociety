<?php
$xpdo_meta_map['SocietyTopic']= array (
  'package' => 'modSociety',
  'version' => '1.1',
  'extends' => 'modResource',
  'fields' => 
  array (
      'show_in_tree' => 1,
      'class_key'   =>  'SocietyTopic',
  ),
  'fieldMeta' => 
  array (),
  'composites' => 
  array (
    'Attributes' => 
    array (
      'class' => 'SocietyTopicAttributes',
      'local' => 'id',
      'foreign' => 'resourceid',
      'cardinality' => 'one',
      'owner' => 'local',
    ),
    'TopicBlogs' => 
    array (
      'class' => 'SocietyBlogTopic',
      'local' => 'id',
      'foreign' => 'topicid',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'TopicTags' => 
    array (
      'class' => 'SocietyTopicTags',
      'local' => 'id',
      'foreign' => 'topic_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
