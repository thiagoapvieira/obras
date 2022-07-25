<header class="header-desktop3 d-none d-lg-block">
<div class="section__content section__content--p35">
<div class="header3-wrap">

            <div class="header__logo">
                <a href="{{url('home')}}">
                    <!-- <img src="{{asset('images/icon/logo_branca.png')}}" alt="CoolAdmin" /> -->
                    <h2 style="color:#fff;">SISGPR</h2>
                </a>
            </div>

            <!-- <div class="header__navbar">
                <ul class="list-unstyled">
                    <li>
                        <a href="{{url('home')}}">
                            <i class="fas fa-home"></i>
                            <span class="bot-line"></span>Home
                        </a>
                    </li>
                </ul>
            </div> -->

            <div class="header__tool">

                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                            <!-- <img src="images/icon/avatar-01.jpg" alt="John Doe" /> -->
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="#">{{session()->get('userLogado')['nome']}}</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">

                                <div class="content">
                                    <h5 class="name">
                                        <a href="#">{{session()->get('userLogado')['nome']}}</a>
                                    </h5>
                                    <span class="email">{{session()->get('userLogado')['email']}}</span>
                                </div>
                            </div>
                            <!-- <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-account"></i>Meu cadastro (BREVE)
                                    </a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-settings"></i>Alterar a senha (BREVE)</a>
                                </div>
                            </div> -->
                            <div class="account-dropdown__footer">
                                <a href="{{url('/sair')}}">
                                    <i class="zmdi zmdi-power"></i>Sair</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
</div>
</div>
</header>