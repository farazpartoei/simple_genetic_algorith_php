<?php
$startTime=microtime(true);
require_once 'Chromosome.php';
require_once 'People.php';
require_once './Algorithm.php';

$binStrSize=40;
$alg=new Algorithm();
//initialize with 10 people

$people=new People();
for($i=0;$i<10;$i++){
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
    echo "The first 2 chromosomes are best let's mate\n";
    echo "mating " . $people->getMembers()[0] . " and " . $people->getMembers()[1] . PHP_EOL;
    $firstKid=$alg->crossover($people->getMembers()[0],$people->getMembers()[1]);
    $secondKid=$alg->crossover($people->getMembers()[1],$people->getMembers()[0]);

    $firstKid=$alg->mutation($firstKid);
    $secondKid=$alg->mutation($secondKid);

    $people->saveChromosome($firstKid);
    $people->saveChromosome($secondKid);

    $people=$people->sort();
    $people->dump();
    echo "\n----------------------\n";
}

$endTime=microtime(true);
echo "\n\n###### BEST Chromosome= ".$bestChromosome." ###########\n";
echo "\nAlgorithm took ".($endTime-$startTime)." Seconds and $i Generations\n";
