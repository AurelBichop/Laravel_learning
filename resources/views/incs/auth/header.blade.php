@php

use App\CourseUser;

$coursesUser = CourseUser::where('user_id', Auth::user()->id)->get();

@endphp


<nav class="mainmenu mobile-menu">
    <ul>
        <li class="active">
            <a href="{{route('main.home')}}">
                <i class="fas fa-home"></i>
                Accueil
            </a>
        </li>
        <li>
            <a href="{{route('courses')}}">
                <i class="fas fa-ellipsis-v"></i>
                Suivre un cours
            </a>
            <ul class="dropdown px-2 py-3">
                @foreach(\App\Category::all() as $category)
                    <li>
                        <a href="{{route('course.filter', $category->id)}}">
                            {!! $category->icon !!}
                            {{$category->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li>
        </li>
        <li>
            <a href="{{route('instructor.index')}}">
                <i class="fas fa-chalkboard-teacher"></i>
                Formateur
            </a>
            <ul class="dropdown">
                <li><p class="px-2">Passez à la vue Formateur ici : revenez aux cours que vous enseignez.</p></li>
            </ul>
        </li>
        <li>
            <a href="{{route('participant.index')}}">
                <i class="fas fa-book"></i>
                Mes cours
            </a>
            <ul class="dropdown">
                @foreach($coursesUser as $courseUser)
                    <li>
                        <div class="d-flex  ml-2 my-3">
                            <img class="avatar border-rounded" src="/storage/courses/{{$courseUser->course->user_id}}/{{$courseUser->course->image}}"/>
                            <div class="user-infos">
                                <a href="#"><small>{{$courseUser->course->title}}</small></a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>
        <li>
            <a href="{{route('cart.index')}}">
                <i class="fas fa-shopping-cart"></i>
                @if(count(\Cart::session(Auth::user()->id)->getContent()) > 0)
                    <span class="badge badge-pill badge-danger">{{count(\Cart::session(Auth::user()->id)->getContent())}}</span>
                @endif
            </a>
            @if(count(\Cart::session(Auth::user()->id)->getContent()) > 0)
                <ul class="dropdown px-2 py-2 text-center">
                    @foreach(\Cart::session(Auth::user()->id)->getContent() as $item)
                        <li>
                            <div class="d-flex">
                                <img class="avatar border-rounded" src="/storage/courses/{{$item->model->user_id}}/{{$item->model->image}}"/>
                                <div class="user-infos ml-3">
                                    <small>{{$item->model->title}}</small>
                                    <p class="text-danger">{{$item->price}} €</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <ul class="dropdown px-2 py-2">
                    <li>
                        <div class="empty-cart text-center">
                            <p>Votre panier est vide</p>
                            <a href="{{route('courses')}}" class="btn btn-link">Continuez vos achats</a>
                        </div>
                    </li>
                </ul>
            @endif
        </li>
        <li>
            <a href="#">
                <i class="fas fa-heart"></i>
                @if(count(\Cart::session(Auth::user()->id. '_wishlist')->getContent()) > 0)
                    <span class="badge badge-pill badge-danger">{{count(\Cart::session(Auth::user()->id. '_wishlist')->getContent())}}</span>
                @endif
            </a>
            <ul class="dropdown px-2 py-2">
                @if(count(\Cart::session(Auth::user()->id. '_wishlist')->getContent()) > 0)
                    @foreach(\Cart::session(Auth::user()->id. '_wishlist')->getContent() as $itemWish)
                        <li>
                            <div class="d-flex">
                                <img class="avatar border-rounded" src="/storage/courses/{{$itemWish->model->user_id}}/{{$itemWish->model->image}}"/>
                                <div class="user-infos ml-3">
                                    <small>{{$itemWish->name}}</small>
                                    <p class="text-danger">{{$itemWish->price}} €</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                        <li>
                            <div class="empty-cart text-center">
                                <p>Votre liste est vide</p>
                                <a href="{{route('courses')}}" class="btn btn-link">voir les cours</a>
                            </div>
                        </li>
                @endif
            </ul>
        </li>
        <li>
            <a class="nav-link" href="#">
               <img class="avatar-profile border-rounded rounded-circle" src="https://uploads-ssl.webflow.com/5bddf05642686caf6d17eb58/5dc2fd00c29f7abeadd7c332_gPZwCbdS.jpg"/>
            </a>
            <ul class="dropdown">
                <li>
                    <div class="d-flex justify-content-between py-3 px-3">
                        <div class="user-infos">
                            <p>{{Auth::user()->name}}</p>
                            <small>{{Auth::user()->email}}</small>
                        </div>
                    </div>
                </li>
                <div class="dropdown-divider"></div>
                <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            </ul>
        </li>
    </ul>
</nav>
