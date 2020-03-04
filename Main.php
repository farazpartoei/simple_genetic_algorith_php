<?php
$startTime=microtime(true);
require_once 'Chromosome.php';
require_once 'People.php';
require_once './Algorithm.php';

$initialPopulation=10;
$binStrSize=50;
$birthRate=0.2; //how many of population are used for offspring

$alg=new Algorithm();
//initialize with  people

$people=new People();
for($i=0;$i<$initialPopulation;$i++){
    $ch=new Chromosome();
    $ch->initialize($binStrSize);
    $people->saveChromosome($ch);
}
echo "\nInitialization Values are:\n";
$people->dump();
echo "-----------------".PHP_EOL;
echo "First sorted population:\n";
$people=$people->sort();
$people->dump();
$i=0;


while (!$bestChromosome=$alg->bestMatchFound($people)) {

    $i++;
    echo "GENERATION #".$i.PHP_EOL;
    // the best chromosome mates the rest of candidate population
    $numberOfCandidates=$people->size()*$birthRate;
    //lets select $numberOfCandidates for mating
    for($i=1;$i<$numberOfCandidates;$i++){
        echo "mating " . $people->getMembers()[0] . " and " . $people->getMembers()[$i] . PHP_EOL;
        $kid=$alg->crossover($people->getMembers()[0],$people->getMembers()[$i]);
        $kid=$alg->mutation($kid);
        $people->saveChromosome($kid);
    }

    $people=$people->sort();
    $people->dump();
    echo "\n----------------------\n";
}

$endTime=microtime(true);
echo "\n\n###### BEST Chromosome= ".$bestChromosome." ###########\n";
echo "\nAlgorithm took ".($endTime-$startTime)." Seconds and $i Generations\n";
