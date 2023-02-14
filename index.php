<?php
    include './components/Navigation__Bar.php';
    // ===========Condición que siempre copiaré==============
        if(isset($_SESSION['IS_LOGGIN'])){
            if($_SESSION['ROLE'] == 0){
                echo "<script>window.location='http://pioadmsys.rf.gd/pages/Dashboard.php?type=n'</script>";
            }else{
                echo "<script>window.location='http://pioadmsys.rf.gd/pages/Customers.php?type=n'</script>";
            }
        }

?>

    <!-- ---------------Bastante basico, pero es lo que hay, no es para el publico..--------------- -->
    <style>
    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    font-family: 'Open Sans', sans-serif;
    background-color: #FFFFFF;
}

/* ==================Variables CSS============== */
    :root{
        --heading__color:#292929;
        --subheading__color:#007bff;
        --tab__bg:#377dff;
        --log__color:#40E0D0;
        --tab_nav_color:#fff;
        --box__shadow: 0 4px 16px rgb(0 0 0 / 10%);
    }


/* ==================Estilos globales============== */
    a{
        text-decoration: none;
        color: inherit;
    }
    ul{
        list-style-type: none;
    }


/* ==================Estilos de nav================ */
    #navbar{
        position: absolute;
        top:0;
        width: 100%;
    }
    #navbar_home{
        position: sticky;
        top:0;
        width: 100%;
        background-color: var(--tab__bg);
    }
    nav{
        justify-content:space-between;
        align-items:center;
    }
    nav .nav__brand img{
        width: 70px;
        height: 70px;
        object-fit: contain;
    }
    nav .nav__brand span{
        font-weight:bold;
        color: var(--log__color);
    }
    .toggle{
        position: absolute;
        top:20px;
        font-size: 18px;
        display:none;
        right:10px;
        color: #ccc;
    }
    nav .nav__menu ul{
        justify-content: space-evenly;
        align-items: center;
    }
    nav .nav__menu ul li{
        margin: 10px 10px 0px 10px;
    }
    nav .nav__menu ul li a{
        font-weight:bold;
        color: var( --tab_nav_color);
        transition: all 0.3s ease-in-out;
    }   
    nav .nav__menu ul li a:hover{
        color: var(--log__color);
    }
    /* ============NAV responsive=========== */
        @media(max-width:1200px){
            nav{
                flex-direction: column;
            }
        }
        @media(max-width:1000px){
           nav .nav__menu ul{
               flex-direction: column;
           }
            .nav__menu{
               display: none;
               transition: all 0.5s ease-in-out;
           }
           .nav__menu__show{
            display: initial;
            }
           .toggle{
               display: initial;
           }
        }


/* =======================Esto son solo estilos generales, puedes pasar..================= */
    #home__page{
        width: 100%;
        height:100vh;
        color:var(--tab_nav_color);
        background: url(../assets/home_bg.png);
        background-repeat: no-repeat;
        background-size: cover;
        background-position:center;
    }
    #home__page h2{
        font-weight: bold;
    }
    #home__page h1{
        font-weight:bold;
    }
    #home__page .btn-login{
        margin-top:20px;
        color:var(--tab_nav_color);
        font-size: 18px;
        font-weight: bold;
        background-color: var(--log__color);
    }
    #home__page .btn{
        margin-top:20px;
        font-size: 18px;
        font-weight:bold;
        color:var(--tab_nav_color);
        background-color: var(--log__color);
        border: 1px solid var(--log__color);
    }


/* =======================Obviamente el logon tiene que ser bonitoo================ */
    #login__page{
      margin-top:20px;
      color:var(--heading__color);
    }
    #login__page h3,#login__page p{
        font-weight:bold;
        text-transform:uppercase;
    }




    #add_page{
        margin-top:20px;
    }
    #add_page h2, #add_page p{
        color:var(--heading__color);
        font-weight:bold;
        text-transform:uppercase;
    }




    #user_name{
        /* position:sticky;
        top:12%; */
        padding:10px 20px;
        background-color: var(--tab_nav_color);
        box-shadow: var(--box__shadow);
    }
    #user_name h3{
        color:var(--heading__color);
        font-weight:bold;
        font-size:18px;
    }
    #user_name h3 span{
        color:var(--log__color);
        font-size:20px;
    }



    #display_record h2, #display_record p{
        color:var(--heading__color);
        font-weight:bold;
        text-transform:uppercase;
    }
    #display_record{
        margin-top:20px;
    }
  


    #transaction{
        margin-top:20px;
    }
    #transaction h2, #transaction p {
        color:var(--heading__color);
        font-weight:bold;
        text-transform:uppercase;
    }

</style>
       <div class="container-fluid d-flex justify-content-center align-items-center" id="home__page">
           <div class="row">
               <div class="col-12 text-center">
                    <h2>Portal Administrativo de Proyecto Infrastructural Optimizador Banca virtual</h2>
                    <h1>(ADMPAPIOBV)</h1>
                    <a href="<?php echo SITE__PATH; ?>/pages/Login.php?type=n"><button class="btn">Acceso</button></a>
               </div>
           </div>
       </div>

<?php
    include './components/Footer.php';
?>