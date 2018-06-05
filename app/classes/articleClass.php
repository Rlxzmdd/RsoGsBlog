<?php
/**
 * Created by PhpStorm.
 * User: rlxzmdd
 * Date: 2018/5/20
 * Time: 22:06
 */

namespace app\classes;


class articleClass
{
    private $id;
    private $title;
    private $content;
    private $time;
    private $author;
    private $tags;
    private $visits;
    private $likes;
    /**
     * visits 浏览次数
     * likes 点赞次数
     * index 显示等级，-1为删除（即搜索不到），0为不显示在主界面，1为正常情况，2为置顶显示
     * @var int
     */
    private $index;

    public function __construct($id, $title, $content, $time, $author = "", $tags = "", $index = 1, $likes = 0, $visits = 0)
    {
        $this->id = $id;
        $this->title = ($title);
        $this->content = ($content);
        $this->time = ($time);
        $this->author = ($author);
        $this->tags = $tags;
        $this->index = $index;
        $this->likes = $likes;
        $this->visits = $visits;
    }

    public function __toString()
    {
        return '{"id":"' . $this->getId() . '","title":"' . $this->getTitle() . '","content":saaa","time":"' . $this->getTime() . '","author":"' . $this->getAuthor() . '","tags":"' . $this->getTags() . '","index":"' . $this->getIndex() . '","likes":"' . $this->getLikes() . '","visits":"' . $this->getVisits() . '"}';
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function getVisits()
    {
        return $this->visits;
    }
}