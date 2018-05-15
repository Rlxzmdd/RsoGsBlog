<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/4/7
 * Time: 12:55
 */
namespace app\classes;
use app\models\BlogModel;

class itemClass
{
    private $id;
    private $title;
    private $content;
    private $time;
    private $author;
    private $tags;

    /*
visits 浏览次数
likes 点赞次数
index 显示等级，-1为删除（即搜索不到），0为不显示在主界面，1为正常情况，2为置顶显示
     */
    private $visits;
	private $likes;
	private $index;

    public function __construct($id, $title, $content, $time, $author,$tags,$index)
    {
        $this->id = $id;
        $this->title = ($title);
        $this->content = ($content);
        $this->time = ($time);
        $this->author = ($author);
        $this->tags = $tags;
		$this->index = $index;
		$this->setLikes();
		$this->setVisits();
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
    public function getContent()
    {
        return $this->content;
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
	 * @return mixed
	 */
	public function getIndex()
	{
		return $this->index;
	}

	/**
	 * @return mixed
	 */
	public function getLikes()
	{
		return $this->likes;
	}

	/**
	 * @return mixed
	 */
	public function getVisits()
	{
		return $this->visits;
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
    public function setContent($content)
    {
        $this->content = $content;
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

	/**
	 * @param mixed $index
	 */
	public function setIndex($index)
	{
		$this->index = $index;
	}

	/**
	 * @param mixed $likes
	 */
	public function setLikes()
	{
		$this->likes = (new BlogModel())->getPageLikes('article:'.$this->getId());
	}

	/**
	 * @param mixed $visits
	 */
	public function setVisits()
	{
		$this->visits = (new BlogModel())->getPageVisits('article:'.$this->getId());
	}
}