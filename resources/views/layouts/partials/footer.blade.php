
    <style>

        .inicio-sesion-foot{
            font-family: tommy2;
            font-size: 1rem;
            color: #ffffff;
            letter-spacing: 0.2rem;
            text-decoration: ;
        }

        .linea-footer{
            height: 0.2rem;
            border-radius: 23px;
            background-color: #ffffff;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .footer{
            color: #ffffff;
            font-family: tommy3;
            font-size: 1rem;
        }

        @media only screen and (max-width: 768px){

        }

        @media only screen and (max-width: 390px){

        }

    </style>


<footer class="col-12 d-flex flex-wrap justify-content-center align-items-center" style="background-color: #353352; padding: 17rem 0px 10rem 0px;">
    <div class="col-9" style="background-color:;">
        <div class="col-12 d-flex flex-row" style="height: 4rem;">
            <div class="col-5 d-flex justify-content-start align-items-center">
                <img src="{{asset('img/footer/logo.png')}}" style="height: 100%;" alt="">
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
                <div class="col-12 d-flex justify-content-center align-items-center" style="height: 100%; color:#ffffff;" >
                    <i class="fa-solid fa-bars" style="font-size: 2rem;"></i>
                </div>
            </div>
            <div class="col-5 d-flex justify-content-end align-items-center">
                <div class="inicio-sesion-foot">INICIAR SESION</div>
                <img src="{{asset('img/footer/carrito.png')}}" style="height: 40%; margin-left: 3rem;" alt="">
            </div>
        </div>
        <div class="col-12 linea-footer"></div>
        <div class="col-12 d-flex flex-row justify-content-center align-items-center" style="height: 4rem;">
            <div class="col-6 d-flex justify-content-start align-items-center footer">
                Brincolines bambinos la fabrica 2024 todos los derechos reservados
            </div>
            <div class="col-6 d-flex flex-row justify-content-center align-items-center" style="height: 100%">
                <div class="col-3 d-flex justify-content-center align-items-center footer">Aviso de provacidad</div>
                <div class="col-3 d-flex justify-content-center align-items-center footer">Politicas</div>
                <div class="col-3 d-flex justify-content-center align-items-center footer">FAQS</div>
                <div class="col-3 d-flex justify-content-center align-items-center footer" style="height: 100%">
                    <img class="px-1" src="{{asset('img/footer/whats.png')}}" alt="" style="height: 40%">
                    <img class="px-1" src="{{asset('img/footer/insta.png')}}" alt="" style="height: 40%">
                    <img class="px-1" src="{{asset('img/footer/face.png')}}" alt="" style="height: 40%">
                    <img class="px-1" src="{{asset('img/footer/tik-tok.png')}}" alt="" style="height: 40%">
                    <img class="px-1" src="{{asset('img/footer/youtube.png')}}" alt="" style="height: 40%">
                </div>
            </div>
        </div>
    </div>
</footer>
