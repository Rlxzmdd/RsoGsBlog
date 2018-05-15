<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/4/6
 * Time: 22:34
 */
class printHtml{
    private $id;
    private $title;
    private $text;
    private $img;
    private $time;
    private $author;
    public function __construct($id,$title,$text,$img,$time,$author){
        $this->id=$id;
        $this->title=$title;
        $this->text=$text;
        $this->img=$img;
        $this->time=$time;
        $this->author=$author;
    }

    public function printH(){
        print_r('
    <article class="blog-main" onclick=\'window.location.href="article.php?id='.$this->id.'"\'>
      <h3 class="am-article-title">
        <a>'.$this->title . '</a>
      </h3>
      <h4 class="am-article-meta blog-meta">by<a href="">'.$this->author.'</a> posted on '.$this->time.'</a>
      </h4>
      <div class="am-g blog-content">
        <div class="am-u-lg-12">
          '.substr($this->text,0,199).'......
        </div>
      </div>
    </article>
    <hr class="am-article-divider blog-hr">
'
        );
    }
    public function printPagesHtml(){
        print_r('
    <article class="blog-main" onclick=\'window.location.href="article.php?id='.$this->id.'"\'>
      <h3 class="am-article-title">
        <a>'.$this->title . '</a>
      </h3>
      <h4 class="am-article-meta blog-meta">by<a href="">'.$this->author.'</a> posted on '.$this->time.'</a>
      </h4>
      <div class="am-g blog-content">
        <div class="am-u-lg-12">
          '.$this->text.'
        </div>
      </div>
    </article>
    <hr class="am-article-divider blog-hr">
'
        );
    }
    static function printPage($pages,$nums){
        print_r('<ul class="am-pagination blog-pagination">');
        if($nums <= 5 && $nums >= 1){
            print_r('</ul>');
            return;
        }
        if($pages*5 < $nums){
            print_r('<li class="am-pagination-next"><a href="index.php?num='.($pages+1).'">下一页&raquo;</a></li>');
            print_r('</ul>');
            return;
        }elseif ($pages*5 > $nums){
            print_r('<li class="am-pagination-prev"><a href="index.php?num='.($pages-1).'">&laquo; 上一页</a></li>');
            print_r('</ul>');
            return;
        }else{
            print_r('<li class="am-pagination-prev"><a href="index.php?num='.($pages-1).'">&laquo; 上一页</a></li>');
            print_r('<li class="am-pagination-next"><a href="index.php?num='.($pages+1).'">下一页&raquo;</a></li>');
            print_r('</ul>');
            return;
        }
    }
}