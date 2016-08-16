<?php

/*
 * This file is part of the Pagerfanta package.
 *
 * (c) Pablo Díez <pablodip@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MyPagerfanta\View\Template;

/**
 * @author Pablo Díez <pablodip@gmail.com>
 */
class UserThemeTemplate extends \Pagerfanta\View\Template\Template
{
    // static protected $defaultOptions = array(
    //     'prev_message'        => '&larr; Previous',
    //     'next_message'        => 'Next &rarr;',
    //     'dots_message'        => '&hellip;',
    //     'active_suffix'       => '',
    //     'css_container_class' => 'pagination',
    //     'css_prev_class'      => 'prev',
    //     'css_next_class'      => 'next',
    //     'css_disabled_class'  => 'disabled',
    //     'css_dots_class'      => 'disabled',
    //     'css_active_class'    => 'active',
    // );

    static protected $defaultOptions = array(
        'css_li_class'        => 'page',
        'current_css'         => 'active',
        'prev_ico'            => '← First',
        'next_ico'            => 'Last → ',
        'prev_message'        => '← Previous',
        'next_message'        => 'Next → ',
        'dots_message'        => '...',
        'active_suffix'       => '',
        'css_container_class' => 'pagination',
        'css_prev_class'      => 'prev ',
        'css_next_class'      => 'next ',
        'css_prev_ico_class'  => 'first',
        'css_next_ico_class'  => 'last',
        'css_disabled_class'  => 'disabled',
        'css_dots_class'      => 'disabled',
        'css_active_class'    => 'active',
    );

    public function container()
    {
        return sprintf('<ul class="%s">%%pages%%</div>',
            $this->option('css_container_class')
        );
    }

    public function page($page)
    {
        $text = $page;

        return $this->pageWithText($page, $text);
    }

    public function pageWithText($page, $text)
    {
        // $class = null;
        $class= $this->option('css_li_class');

        return $this->pageWithTextAndClass($page, $text, $class);
    }

    private function pageWithTextAndClass($page, $text, $class)
    {
        $href = $this->generateRoute($page);

        return $this->linkLi($class, $href, $text);
    }

    public function previousDisabled()
    {
        return null;
    }

    private function previousDisabledClass()
    {
        return $this->option('css_prev_class').' '.$this->option('css_disabled_class');
    }

    public function previousEnabled($page)
    {
        $text = $this->option('prev_message');
        $class = $this->option('css_prev_class');
        return $this->pageWithTextAndClass($page, $text, $class);
    }

    public function nextDisabled()
    {
        return null;
    }

    private function nextDisabledClass()
    {
        return $this->option('css_next_class').' '.$this->option('css_disabled_class');
    }

    public function nextEnabled($page)
    {
        $text = $this->option('next_message');
        $class = $this->option('css_next_class');
        return $this->pageWithTextAndClass($page, $text, $class);
    }

    public function first()
    {
        return $this->page(1);
    }

    public function last($page)
    {
        return $this->page($page);
    }

    public function current($page)
    {
        $text = trim($page.' '.$this->option('active_suffix'));
        $class = $this->option('current_css');

        // return $this->spanLi($class, $text);
         $liClass = $class ? sprintf(' class="%s"', $class) : '';
        return sprintf('<li%s><a href="javascript:;">%s</a></li>', $liClass, $text);
    }

    public function separator()
    {
        $class = $this->option('css_dots_class');
        $text = $this->option('dots_message');

        return $this->spanLi($class, $text);
    }

    private function linkLi($class, $href, $text)
    {
        $liClass = $class ? sprintf(' class="%s"', $class) : '';

        return sprintf('<li%s><a href="%s">%s</a></li>', $liClass, $href, $text);
    }

    private function spanLi($class, $text)
    {
        $liClass = $class ? sprintf(' class="%s"', $class) : '';

        return sprintf('<li%s><span>%s</span></li>', $liClass, $text);
    }




    // public function lastAfternext($page)
    // {
    //     $text = $this->option('next_ico');
    //     $class = $this->option('css_next_ico_class');
    //     return $this->pageWithTextAndClass($page, $text, $class);
    // }

    // public function firstBeforePrev()
    // {
    //     $text = $this->option('prev_ico');
    //     $class = $this->option('css_prev_ico_class');
    //     return $this->pageWithTextAndClass(1, $text, $class);
    // }
}
