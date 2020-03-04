<?php
require_once 'Chromosome.php';
require_once 'People.php';

class Algorithm
{




    public function crossover(Chromosome $c1,Chromosome $c2)
    {
        /*if(bindec($c1>bindec($c2)))
            return $c1;
        else
            return $c2;*/

        $size=count($c1->getGens());
        $border=rand(0,$size-1);

        $child=new Chromosome();
        $newGenes=array();
        for($i=0;$i<$border;$i++)
            $newGenes[$i]=$c1->getGens()[$i];
        for($j=$i;$j<$size;$j++)
            $newGenes[$j]=$c2->getGens()[$j];

        $child->setGens($newGenes);
        return $child;

    }
    public function mutation(Chromosome $chromosome)
    {
        $size=count($chromosome->getGens());
        $candidateGene=rand(0,$size-1);
        $genes=$chromosome->getGens();
        if($genes[$candidateGene]==0){
            $genes[$candidateGene]=1;
            $chromosome->setGens($genes);
        }else{
            $genes[$candidateGene]=0;
            $chromosome->setGens($genes);
        }

        return $chromosome;

    }
    public function bestMatchFound(People $people)
    {

        $members=$people->getMembers();
        $size=count($members[0]->getGens());
        $bestScore=pow(2,$size)-1;
        foreach ($members as $member){
            if(bindec($member)==$bestScore){ //actually fitness function is bin2dec in this example
                return $member;
            }
        }
        return false;
    }


}