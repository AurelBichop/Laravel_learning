@extends('layouts.app')


@section('content')


<div class="container mb-4 pb-5">
    <p>{{count(\Cart::session(Auth::user()->id)->getContent())}} cours dans le panier</p>
    <div class="jumbotron">
        @if(count(\Cart::session(Auth::user()->id)->getContent()) > 0)
            <div class="d-flex justify-content-center mb-5">
                <a href="{{route('cart.clear')}}" class="btn btn-block btn-light w-25">
                    Vider le panier
                </a>
            </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">

                    <table class="table table-striped">
                        <tbody>
                        @foreach(\Cart::session(Auth::user()->id)->getContent() as $course)

                            @php

                                $tax = \Cart::getTotal() / 10;
                                $roundedTax = round($tax, 2);

                            @endphp

                            <tr>
                                <td><img class="cart-img" src="/storage/courses/{{ $course->model->user_id }}/{{ $course->model->image }}" /> </td>
                                <td><p><b>{{ $course->model->title }}</b></p><p>{{ $course->model->user->name }}</p></td>
                                <td class="text-left">
                                    <small><a class="btn border" href="{{route('cart.destroy', $course->id)}}">Supprimer</a></small><br>
                                    <small><a class="btn border" href="{{route('wish.towish', $course->id)}}">Ajouter à la liste de souhaits</a></small>
                                </td>
                                <td class="text-right">{{ $course->price }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Sous-total</td>
                                <td class="text-right">{{ \Cart::getSubtotal() }} €</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Taxe</td>
                                <td class="text-right">{{$roundedTax}} €</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td class="text-right"><strong>{{ \Cart::getTotal()+$roundedTax }} €</strong></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a href="#" class="btn btn-block btn-light">Continuer vos achats</a>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <a href="#" class="btn btn-lg btn-block btn-success text-uppercase">Payer</a>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="empty-cart text-center">
                <i class="fas fa-shopping-cart fa-7x"></i>
                    <h4 class="my-5">
                        Votre panier est vide. Continuez vos achats et trouvez un cours !
                        <a href="{{ route('courses') }}" class="primary-btn">
                            Continuez vos achats
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </h4>
            </div>
        @endif
    </div>

    <div class="wish-list jumbotron pt-3">
        @if(count(\Cart::session(Auth::user()->id . '_wishlist')->getContent()) > 0)
            <h3 class="my-3">Récemment ajouté à la liste de souhaits</h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        @foreach(\Cart::session(Auth::user()->id . '_wishlist')->getContent() as $wish)
                            <tr>
                                <td><img class="cart-img" src="/storage/courses/{{ $wish->model->user_id }}/{{ $wish->model->image }}" /> </td>
                                <td><p><b>{{$wish->name}}</b></p><p>{{$wish->model->user->name}}</p></td>
                                <td class="text-left">
                                    <small><a class="btn border" href="{{route('wish.destroy', $wish->id)}}">Supprimer</a></small><br>
                                    <small><a class="btn border" href="{{route('wish.tocart', $wish->id)}}">Ajouter au panier</a></small>
                                </td>
                                <td class="text-right">{{$wish->price}} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-cart text-center">
                    <h4 class="my-5">
                        Pas de cours dans votre liste de souhaits
                        <a href="{{ route('courses') }}" class="primary-btn">
                            Voir la liste des cours
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </h4>
            </div>
        @endif
    </div>
</div>

@endsection
