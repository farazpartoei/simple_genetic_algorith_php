<?php


class Chromosome
{
    private $gens;


    public function __construct()
    {
        $this->gens=array();
    }
    public function initialize($size)
    {
        for($i=0;$i<$size;$i++){
            if(rand() % 2 == 0)
                $randomGene=0;
            else
                $randomGene=1;

            $this->gens[$i]=$randomGene;
        }

    }

    /**
     * @return array
     */
    public function getGens()
    {
        return $this->gens;
    }

    /**
     * @param array $gens
     */
    public function setGens($gens)
    {
        $this->gens = $gens;
    }

    public function __toString()
    {
        $str="";
        for($i=0;$i<count($this->gens);$i++)
            $str.=$this->gens[$i];
        return $str;
    }


}