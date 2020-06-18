<header class="header-section">
    <div class="container-fluid">
        <div class="nav-menu">
            <nav class="mainmenu mobile-menu">
                <ul>
                    <li class="active">
                        <a href="{{route('main.home')}}">
                            <i class="fas fa-home"></i>
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-chalkboard-teacher"></i>
                            Participant
                        </a>
                        <ul class="dropdown">
                            <li><p class="px-2">Passez à la vue Participant ici : revenez aux cours que vous suivez.</p></li>
                        </ul>
                    </li>
                    <li>
                    <li>
                        <a class="nav-link" href="#">
                        <img class="w-25 border-rounded rounded-circle" src="https://uploads-ssl.webflow.com/5bddf05642686caf6d17eb58/5dc2fd00c29f7abeadd7c332_gPZwCbdS.jpg"/>
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
                                 <li><a href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                             </ul>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
</header>
