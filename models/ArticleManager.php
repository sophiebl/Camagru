<?php
class ArticleManager extends Model
{
    public function getArticles()
    {
        echo '  Article manager  ';
        return $this->getAll('articles', 'Article');
    }
}