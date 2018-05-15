<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/4/7
 * Time: 12:55
 */

class itemClass
{
    private $id;
    private $title;
    private $text;
    private $time;
    private $author;
    private $tags;

    public function __construct($id, $title, $text, $time, $author,$tags)
    {
        $this->id = $id;
        $this->title = ($title);
        $this->text = ($text);
        $this->time = ($time);
        $this->author = ($author);
        $this->tags = $tags;
    }


    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

	/**
	 * @return mixed
	 */
	public function getTags()
	{
		return $this->tags;
	}

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

	/**
	 * @param mixed $tags
	 */
	public function setTags($tags)
	{
		$this->tags = $tags;
	}

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function addOne(sqlUtils $s){
    	$sql = 'INSERT INTO `'.$s->getDBName().'`.`blogats` (`id`, `title`, `text`, `time`, `author`, `tags`)
VALUES (NULL, \''.$this->getTitle().'\', \''.$this->getText().'\',  \''.$this->getTime().'\', \''.$this->getAuthor().'\', \''.$this->getTags().'\');';
    	//print_r($sql);
    	$s->connect();
    	return $s->query($sql);
	}
}