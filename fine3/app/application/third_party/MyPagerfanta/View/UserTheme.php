<?php

namespace MyPagerfanta\View;
// use Pagerfanta\View\Template\TwitterBootstrapTemplate;
use MyPagerfanta\View\Template\UserThemeTemplate;
use Pagerfanta\PagerfantaInterface;

class UserTheme extends \Pagerfanta\View\DefaultView
{

    protected function createDefaultTemplate()
    {
        return new UserThemeTemplate();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user_theme';
    }

    // private function generatePages()
    // {
    //     $this->calculateStartAndEndPage();

    //     return $this->firstBeforePrev().
    //            $this->previous().
    //            $this->first().
    //            $this->secondIfStartIs3().
    //            $this->dotsIfStartIsOver3().
    //            $this->pages().
    //            $this->dotsIfEndIsUnder3ToLast().
    //            $this->secondToLastIfEndIs3ToLast().
    //            $this->last().
    //            $this->next().
    //            $this->lastAfternext();
    // }

    // private function firstBeforePrev()
    // {
    //     if ($this->startPage > 1) {
    //         return $this->template->firstBeforePrev();
    //     }
    // }

    // private function lastAfternext()
    // {
    //     if ($this->pagerfanta->getNbPages() > $this->endPage) {
    //         return $this->template->lastAfternext($this->pagerfanta->getNbPages());
    //     }
    // }



}