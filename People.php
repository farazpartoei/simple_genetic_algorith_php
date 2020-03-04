<?php
require_once 'Chromosome.php';

class People
{


    private $members;

    public function __construct()
    {
        $this->members=array();
    }

    public function saveChromosome(Chromosome $chromosome)
    {
        array_push($this->members,$chromosome);

    }

   public function sort()
   {
       if(!function_exists("cmp")) {
           function cmp($a, $b)
           {
               if (bindec($a) > bindec($b))
                   return -1;
               else
                   return 1;
           }
       }
       usort($this->members,"cmp");
       return $this;
   }


   public function dump()
   {
       foreach ($this->members as $member){
           echo $member.PHP_EOL;
       }
   }
    /**
     * @return array
     */
    public function getMembers()
    {
        return $this->members;
    }

    private function calcScore(Chromosome $chromosome)
    {
        return bindec($chromosome);
    }


}