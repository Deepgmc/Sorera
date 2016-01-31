<?php

class pagerHypten
{
    public function __toString()
    {
        $return_page = '';
        $page = $this->getCurPage();
        if (empty($page)) $page = 1;
        $number = (int)($this->get_total() / $this->get_pnumber());
        if ((float)($this->get_total() / $this->get_pnumber()) - $number != 0) {
            $number++;
        }

        if ($page - $this->get_page_link() > 1) {
            $return_page .=
                "<a href=#>"
                . "1-{$this->get_pnumber()}"
                . "</a>&nbsp;&nbsp;...&nbsp;&nbsp;";
            for ($i = $page - $this->get_page_link(); $i < $page; $i++) {
                $return_page .= "&nbsp;<a href=#>"
                    . (($i - 1) * $this->get_pnumber() + 1)
                    . "-" . $i * $this->get_pnumber()
                    . "</a>&nbsp;";
            }
        } else {
            for ($i = 1; $i < $page; $i++) {
                $return_page .= "&nbsp;<a href=#>"
                    . (($i - 1) * $this->get_pnumber() + 1)
                    . "-" . $i * $this->get_pnumber()
                    . "</a>&nbsp;";
            }
        }


        if ($page + $this->get_page_link() < $number) {
            for ($i = $page; $i <= $page + $this->get_page_link(); $i++) {
                if ($page == $i) {
                    $return_page .=
                        '&nbsp;&nbsp;<span>'
                        . (($i - 1) * $this->get_pnumber() + 1) . '-' . $i * $this->get_pnumber()
                        . '</span>&nbsp;&nbsp;';
                } else {
                    $return_page .=
                        '&nbsp;&nbsp;<A href=#>'
                        . (($i - 1) * $this->get_pnumber() + 1) . '-' . $i * $this->get_pnumber()
                        . '</a>&nbsp;&nbsp;';
                }
            }
            $return_page .= '&nbsp;...&nbsp;&nbsp;<a href=#>'
                . (($number - 1) * $this->get_pnumber() + 1)
                . "-{$this->get_total()}"
                . '</a>&nbsp;';
        } else {
            for ($i = $page; $i <= $number; $i++) {
                if ($number == $i) {
                    if ($page == $i) {
                        $return_page .=
                            '&nbsp;&nbsp;<span>'
                            . (($i - 1) * $this->get_pnumber() + 1) . '-' . $this->get_total()
                            . '</span>&nbsp;&nbsp;';
                    } else {
                        $return_page .=
                            '&nbsp;&nbsp;<A href=#>'
                            . (($i - 1) * $this->get_pnumber() + 1) . '-' . $this->get_total()
                            . '</A>&nbsp;&nbsp;';
                    }
                } else {
                    if ($page == $i) {
                        $return_page .=
                            '&nbsp;&nbsp;<span>'
                            . (($i - 1) * $this->get_pnumber() + 1) . '-' . $i * $this->get_pnumber()
                            . '</span>&nbsp;&nbsp;';
                    } else {
                        $return_page .=
                            '&nbsp;&nbsp;<A href=#>'
                            . (($i - 1) * $this->get_pnumber() + 1) . '-' . $i * $this->get_pnumber()
                            . '</A>&nbsp;&nbsp;';
                    }
                }
            }
        }
        return $return_page;
    }//to string
}//class

class pagerClear
{
    public function __toString()
    {
        if(count($this->getGETs()) > 0) $gets = $this->getGETs();
        $tmp = explode ('?', $_SERVER['REQUEST_URI']);
        $link = $tmp[0];
        $h = false;
        if(isset($gets)){
            $c1 = 0;
            foreach($gets AS $name => $param){
                if($name=='page') continue;
                $h = true;
                $link .= ($c1 == 0 ? '?' : '&') . $name . '=' . $param;
                $c1++;
            }
        }

        $return_page = '';
        $page = $this->getCurPage();
        if (empty($page)) $page = 1;
        $number = (int)($this->get_total() / $this->get_pnumber());
        if ((float)($this->get_total() / $this->get_pnumber()) - $number != 0) {
            $number++;
        }
        if ($page - $this->get_page_link() > 1) {
            $return_page .= '<a href='. $link . ($h ? '&page=1' : '?page=1') .'>1</a>&nbsp;&nbsp;...&nbsp;&nbsp;';
            for ($i = $page - $this->get_page_link(); $i < $page; $i++) {
                $return_page .= '&nbsp;<a href='. $link . ($h ? '&page='.$i : '?page='.$i) .'>' . $i . '</a>&nbsp;';
            }
        } else {
            for ($i = 1; $i < $page; $i++) {
                $return_page .= '&nbsp;<a href='. $link . ($h ? '&page='.$i : '?page='.$i) .'>' . $i . '</a>&nbsp;';
            }
        }


        if ($page + $this->get_page_link() < $number) {
            for ($i = $page; $i <= $page + $this->get_page_link(); $i++) {
                if ($page == $i) {
                    $return_page .= '&nbsp;&nbsp;<span>' . $i . '</span>&nbsp;&nbsp;';
                } else {
                    $return_page .= '&nbsp;&nbsp;<A href='. $link . ($h ? '&page='.$i : '?page='.$i) .'>' . $i . '</a>&nbsp;&nbsp;';
                }
            }
            $return_page .= '&nbsp;...&nbsp;&nbsp;<a href='. $link. ($h ? '&page='.$number : '?page='.$number) .'>' . $number . '</a>&nbsp;';
        } else {
            for ($i = $page; $i <= $number; $i++) {
                if ($number == $i) {
                    if ($page == $i) {
                        $return_page .= '&nbsp;&nbsp;<span>' . $i . '</span>&nbsp;&nbsp;';
                    } else {
                        $return_page .=
                            '&nbsp;&nbsp;<A href='. $link . ($h ? '&page='.$i : '?page='.$i) .'>' . $i . '</A>&nbsp;&nbsp;';
                    }
                } else {
                    if ($page == $i) {
                        $return_page .= '&nbsp;&nbsp;<span>' . $i . '</span>&nbsp;&nbsp;';
                    } else {
                        $return_page .= '&nbsp;&nbsp;<A href='. $link . ($h ? '&page='.$i : '?page='.$i) .'>' . $i . '</A>&nbsp;&nbsp;';
                    }
                }
            }
        }
        return $return_page;
    }//to string
}//class