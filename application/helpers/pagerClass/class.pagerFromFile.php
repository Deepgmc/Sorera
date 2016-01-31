<?php

require_once 'class.pager.php';

class pager_file extends pagerClear
{
  protected $fileName;//���� � �����
  private $pnumber;//���������� ������� �� ��������
  private $page_link;//���������� ������ ����� � ������ �� ������� ��������
  private $curPage;//������� �������� ��� ������� ���������� ������

  public function __construct($fileName, $curPage, $pnumber=10, $page_link=3)
  {
    $this->fileName=$fileName;
    $this->curPage=$curPage;
    $this->pnumber=$pnumber;
    $this->page_link=$page_link;
  }
  protected function getCurPage()
  {
    return $this->curPage;
  }
  public function get_total()
  {
    //������� ���������� ������� � �����
    $counter=0;
    $f=fopen($this->fileName,'r');
    if($f)
    {
      while(!feof($f))
      {
        fgets($f,10000);
        $counter++;
      }
      fclose($f);
    }
    return $counter;
  }
  public function get_pnumber()
  {
    //���������� ������� �� ��������
    return $this->pnumber;
  }
  public function get_page_link()
  {
    //���������� ������ ����� � ������ �� ������� ��������
    return $this->page_link;
  }
  public function get_page()
  {
    //������� ��������
    $page = $this->curPage;
    if(empty($page))$page=1;
    $total = $this->get_total();
    
    //��������� ����� ������� �����
    $number = (int)($total/$this->get_pnumber());
    if((float)($total/$this->get_pnumber() - $number != 0)) $number++;
    
    //��������� �������� �� ������������� ����� �� 1 �� get_total()
    if($page <=0 || $page > $number) return 0;
    
    //��������� ������� ������� ��������
    $arr = array();
    $f=fopen($this->fileName,'r');
    if(!$f)return 0;
    //����� ������� � �������� ������� �������� ������ �����
    $first = ($page-1)*$this->get_pnumber();
    for($i=0;$i<$total;$i++)
    {
      $str = fgets($f,10000);
      if($i<$first)continue;
      if($i > $first + $this->get_pnumber() - 1) break;
      $arr[] = $str;
    }
    fclose($f);
    return $arr;
  }
}





class pager_db extends pagerClear
{
  protected $tableName;
  private $pnumber;
  private $page_link;
  private $curPage;
  private $gets = array();

  public function __construct($total, $curPage, $pnumber=10, $page_link=3, $gets)
  {
    $this->total=$total;
    $this->curPage=$curPage;
    $this->pnumber=$pnumber;
    $this->page_link=$page_link;
    $this->gets = $gets;
  }
  protected function getCurPage()
  {
    return $this->curPage;
  }
  protected function getGETs()
  {
    return $this->gets;
  }
  public function get_total()
  {
    return $this->total;
  }
  public function get_pnumber()
  {
    return $this->pnumber;
  }
  public function get_page_link()
  {
    return $this->page_link;
  }
}