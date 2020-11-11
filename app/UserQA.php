<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserQA extends Model
{
    protected $table = 'user_qas';
    protected $guarded = [];

    const QUESTIONS = [
      '1' => 'What realm do you cherish ?',
      '2' => 'What do you love the most ?',
      '3' => 'Fighting style ?'
    ];

    const QUESTION_ONE_OPTIONS = [
      '1' => 'Love (Alta)',
      '2' => 'I want to be a Receptacle of pure demonic power. (Lowa)',
    ];

    const QUESTION_TWO_OPTIONS = [
      '1' =>  'Being alone',
      '2' =>  'Jealousy',
      '3' =>  'Equality ',
      '4' =>  'Causing chaos (visual, physical)',
      '5' =>  'Causing chaos (mental)',
      '6' =>  'Nature',
      '7' =>  'Being welcomed',
      '8' =>  'Being immune to pain',
      '9' =>  'Feeling pain',
      '10' => 'Spirits',
      '11' => 'Emptiness',
      '12' => 'Peace',
      '13' => 'Elevation (visual, physical)',
      '14' => 'Artillery',
      '15' => 'The actual world',
      '16' => 'Death',
      '17' => 'Freedom',
      '18' => 'Inhumans ',
      '19' => 'Darkness',
      '20' => 'Light',
      '21' => 'Space (outer territories)',
      '22' => 'Robots and machinery',
      '23' => 'Originality',
      '24' => 'Animals',
      '25' => 'Laziness',
    ];

    const QUESTION_THREE_OPTIONS = [
      '1' => 'Tactical ',
      '2' => 'Warrior ',
      '3' => 'Enforcer ',
      '4' => 'Caster',
      '5' => 'Assassin ',
    ];
}
