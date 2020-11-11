@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @php
                $user = Auth::user();
            @endphp
            @if($user->getRoleNames()->first() == 'user')
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">Hello {{ Auth::user()->name }}</div>
                        <div class="card-body">
                            <p>
                                Welcome to Vibrant Universe which is an ever-growing community of players and writers
                                creating a never-ending story in Vibra, a world of infinite possibilities allowing you
                                to play and put yourself in the position of a character that you create and manage along
                                your palpitating journey. On our platform, you can incarnate a character, fight other
                                players in an original Chat Arena that comes with a unique system that requires skills,
                                strategy, and most importantly FAIR-PLAY. Do missions, take quizzes, participate in
                                tournaments and our famous Battle Royale, earn Viis so you can climb at the top of the
                                ladder with hard-earned titles. But remember, every action counts. Good luck, and have
                                fun dear Extremists and Receptacles !

                            </p>
                            <br>
                            <p>Since the website is in its Beta version, join our Discord and help us with ideas and
                                bugs tracking: link to Discord.</p>
                            <br>
                            <h3>Vibrant Honors</h3>
                            <ul>
                                <li>Welcome to our latest member: user44 (name of the last registered member)</li>
                                <li>The user with the most likes is: user31 with 300 likes</li>
                                <li>The user with the most posts and comments is: user11 with 54 posts/comments</li>
                                <li>The richest user right now is user99 with 1590 Viis</li>
                            </ul>
                            <br>
                            <h3>F.A.Q</h3>
                            <br>
                            <h5>-How does the avatar system work ?</h5>
                            <p>The staff provides you an avatar based on a character that you choose in a list of
                                available ones. Know that every single character has a vast or decent amount of avatars,
                                but for progression logic, you will unlock them as you play. In an upcoming update, you
                                will be able to choose your avatar among those that you’ve earned.</p>

                            <br>
                            <h5>-Why can’t I choose my avatar ?</h5>
                            <p>Simply for trolling purposes. We don’t doubt you being an expert in making avatars and
                                you could eventually bless yourself with better looking ones, but we don’t want no
                                “drunk cat” pictures or some “enraged Donald Trump”. Thank you.</p>
                            <br>
                            <h5>-I chose Sasuke. Am I really playing Sasuke inRP ?</h5>
                            <p>No. You are playing a representation of Sasuke. You are just an image of him, no
                                memories, no Sharingan, no Naruto antics. Matter fact, let’s put it like this, you are
                                not Sasuke, you look like him.</p>
                            <br>
                            <h5>-How are my sentences created ?</h5>
                            <p>The sentences that you have and that are usable in the Chat Arena were created by the
                                staff. They are far from being random, they are a representation of the choices you made
                                when becoming a member. You will be able to diversify your playstyle by buying new
                                sentences later on.</p>
                            <br>
                            <h5>-How do I get new sentences in the Chat Arena ?</h5>
                            <p>It’s easy. You buy them. At the store. Or you earn them from inRP events.</p>
                            <br>
                            <h5>-Why do I fail every quiz ?</h5>
                            <p>The questions come directly from the LIVE synopsis of Vibra and from some general
                                knowledge about the website and the different systems that built it. Stay up to date
                                with news and stories on the website so you can have a better chance.</p>
                            <br>
                            <h5>-Can I still progress without doing the RPG part ?</h5>
                            <p> Yes, even if you don’t write stories and help the world of Vibra, you can. BUT, it will
                                be way slower than someone who takes a few hours every day or week to develop his
                                character and socialize inRP.</p>
                            <br>
                            <h5>-Can I become admin ?</h5>
                            <p>No.</p>
                            <br>
                            <h5>-Can I become a moderator ?</h5>
                            <p>Not now because we are still in a beta version of the platform. But yes, certainly.</p>
                            <br>
                            <h5>-How long should a RPG post be ?</h5>
                            <p>No less than 8 lines. Your earning of Vii will be greatly reduced if it’s less.</p>
                            <br>
                            <h5>-Am I limited inRP ?</h5>
                            <p>No, not at all. Your character is free of movements and in any form of expression. But,
                                deal with the consequences (death, imprisonment, exile, hatred…)</p>
                            <br>
                            <h5>-What happens when a character dies in RP, or on the Chat Arena ?</h5>
                            <p>In RP, A possible return differs from Receptacle to Extremists. A Receptacle will only
                                lose his physical appearance but can come back, because remember, a Receptacle is no
                                more than an extra dimensional entity that took over one’s body, so the same entity can
                                just switch body. When an Extremist dies, it’s over. They can reincarnate but their
                                memories are gone. In the Chat Arena, duels and fights are usually not part of the main
                                story which means death doesn’t count, unless an admin says so.</p>
                            <br>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">Dashboard</div>

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Total Likes') }}</label>
                                <div class="col-md-6">
                                    <p class="form-control">{{ $userTotalLikes }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
