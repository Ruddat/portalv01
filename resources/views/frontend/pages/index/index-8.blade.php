@extends('frontend.layouts.default')
@section('content')
    <!-- seitenabhengig css -->
    @push('specific-css')

<!-- REVOLUTION SLIDER CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution-slider/fonts/font-awesome/css/font-awesome.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution-slider/css/settings.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution-slider/css/layers.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution-slider/css/navigation.css') }}">


            <!-- SPECIFIC CSS -->
        <link href="{{ asset('frontend/css/home.css') }}" rel="stylesheet">



            <!-- REVOLUTION SLIDER CUSTOM CSS -->
    <style type="text/css">
        .tiny_bullet_slider .tp-bullet:before {
            content: " ";
            position: absolute;
            width: 100%;
            height: 25px;
            top: -12px;
            left: 0px;
            background: transparent
        }
        .bullet-bar.tp-bullets:before {
            content: " ";
            position: absolute;
            width: 100%;
            height: 100%;
            background: transparent;
            padding: 10px;
            margin-left: -10px;
            margin-top: -10px;
            box-sizing: content-box
        }
        .bullet-bar .tp-bullet {
            width: 60px;
            height: 3px;
            position: absolute;
            background: #aaa;
            background: rgba(204, 204, 204, 0.5);
            cursor: pointer;
            box-sizing: content-box
        }
        .bullet-bar .tp-bullet:hover,
        .bullet-bar .tp-bullet.selected {
            background: rgba(204, 204, 204, 1)
        }
    </style>
    @endpush

    <body>

        @include('frontend.includes.header-clearfix-element-to-stick')


       <!-- START SLIDER -->
       <div id="rev_slider_45_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="website-intro" data-source="gallery" style="background:#000000;padding:0px;">
        <div id="rev_slider_45_1" class="rev_slider fullscreenbanner tiny_bullet_slider" style="display:none;" data-version="5.4.8">
            <ul>
                <li data-index="rs-67" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="600" data-thumb="" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="" data-slicey_shadow="0px 0px 0px 0px transparent">
                    <!-- main image -->
                    <img src="revolution-slider/assets/images/slide_4.jpg" alt="" data-bgposition="center center" data-kenburns="on" data-duration="5000" data-ease="Power2.easeInOut" data-scalestart="100" data-scaleend="150" data-rotatestart="0" data-rotateend="0" data-blurstart="20" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-9" data-x="['center','center','center','center']" data-hoffset="['-112','-43','-81','44']" data-y="['middle','middle','middle','middle']" data-voffset="['-219','-184','-185','182']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":300,"speed":1000,"frame":"0","from":"rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3700","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-10" data-x="['center','center','center','center']" data-hoffset="['151','228','224','117']" data-y="['middle','middle','middle','middle']" data-voffset="['-212','-159','71','-222']" data-width="['150','150','100','100']" data-height="['200','150','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":350,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3650","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-29" data-x="['center','center','center','center']" data-hoffset="['339','-442','104','-159']" data-y="['middle','middle','middle','middle']" data-voffset="['2','165','-172','219']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-12" data-x="['center','center','center','center']" data-hoffset="['162','216','-239','193']" data-y="['middle','middle','middle','middle']" data-voffset="['195','245','6','146']" data-width="['250','250','100','100']" data-height="150" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":450,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3550","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-34" data-x="['center','center','center','center']" data-hoffset="['-186','-119','273','-223']" data-y="['middle','middle','middle','middle']" data-voffset="['269','217','-121','69']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":500,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3500","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-11" data-x="['center','center','center','center']" data-hoffset="['-325','292','162','-34']" data-y="['middle','middle','middle','middle']" data-voffset="['3','55','-275','-174']" data-width="150" data-height="['250','150','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":550,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3450","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-27" data-x="['center','center','center','center']" data-hoffset="['-429','523','-190','-306']" data-y="['middle','middle','middle','middle']" data-voffset="['-327','173','181','480']" data-width="['250','250','150','150']" data-height="['300','300','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":320,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3680","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-28" data-x="['center','center','center','center']" data-hoffset="['422','-409','208','225']" data-y="['middle','middle','middle','middle']" data-voffset="['-245','-72','294','-14']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":360,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3640","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 12;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-30" data-x="['center','center','center','center']" data-hoffset="['549','-445','28','58']" data-y="['middle','middle','middle','middle']" data-voffset="['236','400','316','287']" data-width="['300','300','150','200']" data-height="['250','250','150','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-31" data-x="['center','center','center','center']" data-hoffset="['-522','492','-151','262']" data-y="['middle','middle','middle','middle']" data-voffset="['339','-180','330','-141']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":440,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3560","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 14;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-32" data-x="['center','center','center','center']" data-hoffset="['-588','-375','-253','-207']" data-y="['middle','middle','middle','middle']" data-voffset="['72','-328','-172','-111']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":480,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3520","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 15;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-33" data-x="['center','center','center','center']" data-hoffset="['-37','73','-76','-100']" data-y="['middle','middle','middle','middle']" data-voffset="['-401','-340','-293','-246']" data-width="['450','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":310,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3690","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 16;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-67-layer-35" data-x="['center','center','center','center']" data-hoffset="['186','38','116','17']" data-y="['middle','middle','middle','middle']" data-voffset="['363','402','190','395']" data-width="['350','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":340,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3660","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 17;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper " id="slide-67-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"delay":10,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":500,"frame":"999","to":"opacity:0;","ease":"Power4.easeOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 18;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-resizeme" id="slide-67-layer-2" data-x="['center','center','center','center']" data-hoffset="['1','1','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-70','-70','-70','-70']" data-fontsize="['90','90','70','50']" data-lineheight="['90','90','70','50']" data-width="['none','none','481','360']" data-height="none" data-whitespace="['nowrap','nowrap','normal','normal']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 19; white-space: nowrap; font-size: 90px; line-height: 90px; font-weight: 500; color: #ffffff; letter-spacing: -2px;font-family: 'Poppins', Helvetica, sans-serif;">Discover<br />
                       great food</div>
                    <div class="tp-caption tp-resizeme" id="slide-67-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['90','90','60','30']" data-fontsize="['25','25','25','20']" data-lineheight="['35','35','35','30']" data-width="['480','480','480','360']" data-height="none" data-whitespace="normal" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 20; min-width: 480px; max-width: 480px; white-space: normal; font-size: 25px; line-height: 35px; font-weight: 400; color: #ffffff; letter-spacing: 0px;font-family: 'Poppins', Helvetica, sans-serif;">Expolore top rated restaurants and bars around the world!</div>
                    <div class="tp-caption tp-resizeme btn_1" data-actions='[{"event":"click","action":"scrollbelow","offset":"-49px","delay":"","speed":"300","ease":"Linear.easeNone"}]' id="slide-67-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['200','200','160','120']" data-width="250" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='' data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;fb:0;","style":"c:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 21; min-width: 250px; max-width: 250px; white-space: nowrap; font-size: 18px; line-height: 55px; font-weight: 500; border-radius:30px 30px 30px 30px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;text-decoration: none; font-family: 'Poppins', Helvetica, sans-serif;">GET STARTED</div>
                </li>
                <li data-index="rs-66" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="600" data-thumb="" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="" data-slicey_shadow="0px 0px 0px 0px transparent">
                    <img src="revolution-slider/assets/images/slide_5.jpg" alt="" data-bgposition="center center" data-kenburns="on" data-duration="5000" data-ease="Power2.easeInOut" data-scalestart="100" data-scaleend="150" data-rotatestart="0" data-rotateend="0" data-blurstart="20" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-9" data-x="['center','center','center','center']" data-hoffset="['-112','-43','-81','44']" data-y="['middle','middle','middle','middle']" data-voffset="['-219','-184','-185','182']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":300,"speed":1000,"frame":"0","from":"rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3700","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-10" data-x="['center','center','center','center']" data-hoffset="['151','228','224','117']" data-y="['middle','middle','middle','middle']" data-voffset="['-212','-159','71','-222']" data-width="['150','150','100','100']" data-height="['200','150','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":350,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3650","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-29" data-x="['center','center','center','center']" data-hoffset="['339','-442','104','-159']" data-y="['middle','middle','middle','middle']" data-voffset="['2','165','-172','219']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-12" data-x="['center','center','center','center']" data-hoffset="['162','216','-239','193']" data-y="['middle','middle','middle','middle']" data-voffset="['195','245','6','146']" data-width="['250','250','100','100']" data-height="150" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":450,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3550","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-34" data-x="['center','center','center','center']" data-hoffset="['-186','-119','273','-223']" data-y="['middle','middle','middle','middle']" data-voffset="['269','217','-121','69']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":500,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3500","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-11" data-x="['center','center','center','center']" data-hoffset="['-325','292','162','-34']" data-y="['middle','middle','middle','middle']" data-voffset="['3','55','-275','-174']" data-width="150" data-height="['250','150','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":550,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3450","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-27" data-x="['center','center','center','center']" data-hoffset="['-429','523','-190','-306']" data-y="['middle','middle','middle','middle']" data-voffset="['-327','173','181','480']" data-width="['250','250','150','150']" data-height="['300','300','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":320,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3680","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-28" data-x="['center','center','center','center']" data-hoffset="['422','-409','208','225']" data-y="['middle','middle','middle','middle']" data-voffset="['-245','-72','294','-14']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":360,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3640","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 12;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-30" data-x="['center','center','center','center']" data-hoffset="['549','-445','28','58']" data-y="['middle','middle','middle','middle']" data-voffset="['236','400','316','287']" data-width="['300','300','150','200']" data-height="['250','250','150','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-31" data-x="['center','center','center','center']" data-hoffset="['-522','492','-151','262']" data-y="['middle','middle','middle','middle']" data-voffset="['339','-180','330','-141']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":440,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3560","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 14;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-32" data-x="['center','center','center','center']" data-hoffset="['-588','-375','-253','-207']" data-y="['middle','middle','middle','middle']" data-voffset="['72','-328','-172','-111']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":480,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3520","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 15;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-33" data-x="['center','center','center','center']" data-hoffset="['-37','73','-76','-100']" data-y="['middle','middle','middle','middle']" data-voffset="['-401','-340','-293','-246']" data-width="['450','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":310,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3690","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 16;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-66-layer-35" data-x="['center','center','center','center']" data-hoffset="['186','38','116','17']" data-y="['middle','middle','middle','middle']" data-voffset="['363','402','190','395']" data-width="['350','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":340,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3660","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 17;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper " id="slide-66-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"delay":10,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":500,"frame":"999","to":"opacity:0;","ease":"Power4.easeOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 18;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption   tp-resizeme" id="slide-66-layer-2" data-x="['center','center','center','center']" data-hoffset="['1','1','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-70','-70','-70','-70']" data-fontsize="['90','90','70','50']" data-lineheight="['90','90','70','50']" data-width="['none','none','481','360']" data-height="none" data-whitespace="['nowrap','nowrap','normal','normal']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 19; white-space: nowrap; font-size: 90px; line-height: 90px; font-weight: 500; color: #ffffff; letter-spacing: -2px;font-family: 'Poppins', Helvetica, sans-serif;">Exploring<br />New Tastes</div>
                    <div class="tp-caption   tp-resizeme" id="slide-66-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['90','90','60','30']" data-fontsize="['25','25','25','20']" data-lineheight="['35','35','35','30']" data-width="['480','480','480','360']" data-height="none" data-whitespace="normal" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 20; min-width: 480px; max-width: 480px; white-space: normal; font-size: 25px; line-height: 35px; font-weight: 400; color: #ffffff; letter-spacing: 0px;font-family: 'Poppins', Helvetica, sans-serif;">Expolore top rated restaurants and bars around the world!</div>
                    <div class="tp-caption tp-resizeme btn_1" data-actions='[{"event":"click","action":"scrollbelow","offset":"-49px","delay":"","speed":"300","ease":"Linear.easeNone"}]' id="slide-66-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['200','200','160','120']" data-width="250" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='' data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;fb:0;","style":"c:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 21; min-width: 250px; max-width: 250px; white-space: nowrap; font-size: 18px; line-height: 55px; font-weight: 500; border-radius:30px 30px 30px 30px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;text-decoration: none; font-family: 'Poppins', Helvetica, sans-serif;">GET STARTED</div>
                </li>
                <li data-index="rs-68" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="600" data-thumb="" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="" data-slicey_shadow="0px 0px 0px 0px transparent">
                    <img src="revolution-slider/assets/images/slide_3.jpg" alt="" data-bgposition="center center" data-kenburns="on" data-duration="5000" data-ease="Power2.easeInOut" data-scalestart="100" data-scaleend="150" data-rotatestart="0" data-rotateend="0" data-blurstart="20" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-9" data-x="['center','center','center','center']" data-hoffset="['-112','-43','-81','44']" data-y="['middle','middle','middle','middle']" data-voffset="['-219','-184','-185','182']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":300,"speed":1000,"frame":"0","from":"rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3700","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-10" data-x="['center','center','center','center']" data-hoffset="['151','228','224','117']" data-y="['middle','middle','middle','middle']" data-voffset="['-212','-159','71','-222']" data-width="['150','150','100','100']" data-height="['200','150','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":350,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3650","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-29" data-x="['center','center','center','center']" data-hoffset="['339','-442','104','-159']" data-y="['middle','middle','middle','middle']" data-voffset="['2','165','-172','219']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-12" data-x="['center','center','center','center']" data-hoffset="['162','216','-239','193']" data-y="['middle','middle','middle','middle']" data-voffset="['195','245','6','146']" data-width="['250','250','100','100']" data-height="150" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":450,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3550","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-34" data-x="['center','center','center','center']" data-hoffset="['-186','-119','273','-223']" data-y="['middle','middle','middle','middle']" data-voffset="['269','217','-121','69']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":500,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3500","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-11" data-x="['center','center','center','center']" data-hoffset="['-325','292','162','-34']" data-y="['middle','middle','middle','middle']" data-voffset="['3','55','-275','-174']" data-width="150" data-height="['250','150','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":550,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3450","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-27" data-x="['center','center','center','center']" data-hoffset="['-429','523','-190','-306']" data-y="['middle','middle','middle','middle']" data-voffset="['-327','173','181','480']" data-width="['250','250','150','150']" data-height="['300','300','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":320,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3680","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-28" data-x="['center','center','center','center']" data-hoffset="['422','-409','208','225']" data-y="['middle','middle','middle','middle']" data-voffset="['-245','-72','294','-14']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":360,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3640","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 12;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-30" data-x="['center','center','center','center']" data-hoffset="['549','-445','28','58']" data-y="['middle','middle','middle','middle']" data-voffset="['236','400','316','287']" data-width="['300','300','150','200']" data-height="['250','250','150','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-31" data-x="['center','center','center','center']" data-hoffset="['-522','492','-151','262']" data-y="['middle','middle','middle','middle']" data-voffset="['339','-180','330','-141']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":440,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3560","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 14;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-32" data-x="['center','center','center','center']" data-hoffset="['-588','-375','-253','-207']" data-y="['middle','middle','middle','middle']" data-voffset="['72','-328','-172','-111']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":480,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3520","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 15;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-33" data-x="['center','center','center','center']" data-hoffset="['-37','73','-76','-100']" data-y="['middle','middle','middle','middle']" data-voffset="['-401','-340','-293','-246']" data-width="['450','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":310,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3690","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 16;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper tp-slicey  tp-resizeme" id="slide-68-layer-35" data-x="['center','center','center','center']" data-hoffset="['186','38','116','17']" data-y="['middle','middle','middle','middle']" data-voffset="['363','402','190','395']" data-width="['350','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":340,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3660","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 17;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption tp-shape tp-shapewrapper " id="slide-68-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"delay":10,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":500,"frame":"999","to":"opacity:0;","ease":"Power4.easeOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 18;background-color:rgba(0, 0, 0, 0.5);"> </div>
                    <div class="tp-caption   tp-resizeme" id="slide-68-layer-2" data-x="['center','center','center','center']" data-hoffset="['1','1','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-70','-70','-70','-70']" data-fontsize="['90','90','70','50']" data-lineheight="['90','90','70','50']" data-width="['none','none','481','360']" data-height="none" data-whitespace="['nowrap','nowrap','normal','normal']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 19; white-space: nowrap; font-size: 90px; line-height: 90px; font-weight: 500; color: #ffffff; letter-spacing: -2px;font-family: 'Poppins', Helvetica, sans-serif;">Experience <br />with Fooyes</div>
                    <div class="tp-caption tp-resizeme" id="slide-68-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['90','90','60','30']" data-fontsize="['25','25','25','20']" data-lineheight="['35','35','35','30']" data-width="['480','480','480','360']" data-height="none" data-whitespace="normal" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 20; min-width: 480px; max-width: 480px; white-space: normal; font-size: 25px; line-height: 35px; font-weight: 400; color: #ffffff; letter-spacing: 0px;font-family: 'Poppins', Helvetica, sans-serif;">Expolore top rated restaurants and bars around the world!</div>
                    <div class="tp-caption tp-resizeme btn_1" data-actions='[{"event":"click","action":"scrollbelow","offset":"-49px","delay":"","speed":"300","ease":"Linear.easeNone"}]' id="slide-68-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['200','200','160','120']" data-width="250" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='' data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;fb:0;","style":"c:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 21; min-width: 250px; max-width: 250px; white-space: nowrap; font-size: 18px; line-height: 55px; font-weight: 500; border-radius:30px 30px 30px 30px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;text-decoration: none; font-family: 'Poppins', Helvetica, sans-serif;">GET STARTED</div>
                </li>
            </ul>
            <div class="tp-bannertimer tp-bottom" style="height: 5px; background:#e54750;"></div>
        </div>
    </div>
    <!-- END REVOLUTION SLIDER -->

    <div class="container margin_60">
        <div class="main_title center">
            <span><em></em></span>
            <h2>Popular Categories</h2>
            <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
        </div>
        <!-- /main_title -->

        <div class="owl-carousel owl-theme categories_carousel">
            <div class="item_version_2">
                <a href="grid-listing-filterscol.html">
                    <figure>
                        <span>98</span>
                        <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_pizza.jpg" alt="" class="owl-lazy" width="350" height="450">
                        <div class="info">
                            <h3>Pizza</h3>
                            <small>Avg price $40</small>
                        </div>
                    </figure>
                </a>
            </div>
            <div class="item_version_2">
                <a href="grid-listing-filterscol.html">
                    <figure>
                        <span>87</span>
                        <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_sushi.jpg" alt="" class="owl-lazy" width="350" height="450">
                        <div class="info">
                            <h3>Japanese</h3>
                            <small>Avg price $50</small>
                        </div>
                    </figure>
                </a>
            </div>
            <div class="item_version_2">
                <a href="grid-listing-filterscol.html">
                    <figure>
                        <span>55</span>
                        <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_hamburgher.jpg" alt="" class="owl-lazy" width="350" height="450">
                        <div class="info">
                            <h3>Burghers</h3>
                            <small>Avg price $55</small>
                        </div>
                    </figure>
                </a>
            </div>
            <div class="item_version_2">
                <a href="grid-listing-filterscol.html">
                    <figure>
                        <span>55</span>
                        <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_vegetarian.jpg" alt="" class="owl-lazy" width="350" height="450">
                        <div class="info">
                            <h3>Vegetarian</h3>
                            <small>Avg price $40</small>
                        </div>
                    </figure>
                </a>
            </div>
            <div class="item_version_2">
                <a href="grid-listing-filterscol.html">
                    <figure>
                        <span>65</span>
                        <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_bakery.jpg" alt="" class="owl-lazy" width="350" height="450">
                        <div class="info">
                            <h3>Bakery</h3>
                            <small>Avg price $60</small>
                        </div>
                    </figure>
                </a>
            </div>
            <div class="item_version_2">
                <a href="grid-listing-filterscol.html">
                    <figure>
                        <span>25</span>
                        <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_chinesse.jpg" alt="" class="owl-lazy" width="350" height="450">
                        <div class="info">
                            <h3>Chinese</h3>
                            <small>Avg price $40</small>
                        </div>
                    </figure>
                </a>
            </div>
            <div class="item_version_2">
                <a href="grid-listing-filterscol.html">
                    <figure>
                        <span>35</span>
                        <img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_mexican.jpg" alt="" class="owl-lazy" width="350" height="450">
                        <div class="info">
                            <h3>Mexican</h3>
                            <small>Avg price $35</small>
                        </div>
                    </figure>
                </a>
            </div>
        </div>
        <!-- /carousel -->
    </div>
    <!-- /container -->

    <div class="bg_gray">
        <div class="container margin_60_40">
            <div class="main_title">
                <span><em></em></span>
                <h2>Top Rated Restaurants</h2>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
                <a href="#0">View All &rarr;</a>
            </div>
            <div class="row add_bottom_25">
                <div class="col-lg-6">
                    <div class="list_home">
                        <ul>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_1.jpg" alt="" class="lazy" width="350" height="233">
                                    </figure>
                                    <div class="score"><strong>9.5</strong></div>
                                    <em>Italian</em>
                                    <h3>La Monnalisa</h3>
                                    <small>8 Patriot Square E2 9NF</small>
                                    <ul>
                                        <li><span class="ribbon off">-30%</span></li>
                                        <li>Average price $35</li>
                                    </ul>
                                </a>
                            </li>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_2.jpg" alt="" class="lazy" width="350" height="233">
                                    </figure>
                                    <div class="score"><strong>8.0</strong></div>
                                    <em>Mexican</em>
                                    <h3>Alliance</h3>
                                    <small>27 Old Gloucester St, 4563</small>
                                    <ul>
                                        <li><span class="ribbon off">-40%</span></li>
                                        <li>Average price $30</li>
                                    </ul>
                                </a>
                            </li>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_3.jpg" alt="" class="lazy" width="350" height="233">
                                    </figure>
                                    <div class="score"><strong>9.0</strong></div>
                                    <em>Sushi - Japanese</em>
                                    <h3>Sushi Gold</h3>
                                    <small>Old Shire Ln EN9 3RX</small>
                                    <ul>
                                        <li><span class="ribbon off">-25%</span></li>
                                        <li>Average price $20</li>
                                    </ul>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="list_home">
                        <ul>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_4.jpg" alt="" class="lazy" width="350" height="233">
                                    </figure>
                                    <div class="score"><strong>9.5</strong></div>
                                    <em>Vegetarian</em>
                                    <h3>Mr. Pepper</h3>
                                    <small>27 Old Gloucester St, 4563</small>
                                    <ul>
                                        <li><span class="ribbon off">-30%</span></li>
                                        <li>Average price $20</li>
                                    </ul>
                                </a>
                            </li>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_5.jpg" alt="" class="lazy" width="350" height="233">
                                    </figure>
                                    <div class="score"><strong>8.0</strong></div>
                                    <em>Chinese</em>
                                    <h3>Dragon Tower</h3>
                                    <small>22 Hertsmere Rd E14 4ED</small>
                                    <ul>
                                        <li><span class="ribbon off">-50%</span></li>
                                        <li>Average price $35</li>
                                    </ul>
                                </a>
                            </li>
                            <li>
                                <a href="detail-restaurant.html">
                                    <figure>
                                        <img src="img/location_list_placeholder.png" data-src="img/location_list_6.jpg" alt="" class="lazy" width="350" height="233">
                                    </figure>
                                    <div class="score"><strong>8.5</strong></div>
                                    <em>Pizza - Italian</em>
                                    <h3>Bella Napoli</h3>
                                    <small>135 Newtownards Road BT4</small>
                                    <ul>
                                        <li><span class="ribbon off">-45%</span></li>
                                        <li>Average price $25</li>
                                    </ul>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
            <div class="banner lazy" data-bg="url(img/banner_bg_desktop.jpg)">
                <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                    <div>
                        <small>FooYes Delivery</small>
                        <h3>We Deliver to your Office</h3>
                        <p>Enjoy a tasty food in minutes!</p>
                        <a href="grid-listing-filterscol.html" class="btn_1 gradient">Start Now!</a>
                    </div>
                </div>
                <!-- /wrapper -->
            </div>
            <!-- /banner -->
        </div>
    </div>
    <!-- /bg_gray -->

    <div class="shape_element_2">
        <div class="container margin_60_0">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box_how">
                                <figure><img src="img/lazy-placeholder-100-100-white.png" data-src="img/how_1.svg" alt="" width="150" height="167" class="lazy"></figure>
                                <h3>Easly Order</h3>
                                <p>Faucibus ante, in porttitor tellus blandit et. Phasellus tincidunt metus lectus sollicitudin.</p>
                            </div>
                            <div class="box_how">
                                <figure><img src="img/lazy-placeholder-100-100-white.png" data-src="img/how_2.svg" alt="" width="130" height="145" class="lazy"></figure>
                                <h3>Quick Delivery</h3>
                                <p>Maecenas pulvinar, risus in facilisis dignissim, quam nisi hendrerit nulla, id vestibulum.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center">
                            <div class="box_how">
                                <figure><img src="img/lazy-placeholder-100-100-white.png" data-src="img/how_3.svg" alt="" width="150" height="132" class="lazy"></figure>
                                <h3>Enjoy Food</h3>
                                <p>Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros.</p>
                            </div>
                        </div>
                    </div>
                    <p class="text-center mt-3 d-block d-lg-none"><a href="#0" class="btn_1 medium gradient pulse_bt mt-2">Register Now!</a></p>
                </div>
                <div class="col-lg-5 offset-lg-1 align-self-center">
                    <div class="intro_txt">
                        <div class="main_title">
                            <span><em></em></span>
                            <h2>Start Ordering Now</h2>
                        </div>
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet libero id nisi euismod, sed porta est consectetur deserunt.</p>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p><a href="#0" class="btn_1 medium gradient pulse_bt mt-2">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /shape_element_2 -->










        @push('specific-scripts')


<!-- SLIDER REVOLUTION SCRIPTS  -->
<script src="{{ asset('frontend/revolution-slider/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ asset('frontend/revolution-slider/js/extensions/revolution.addon.slicey.min.js') }}"></script>
<script>
var tpj = jQuery;
var revapi45;
tpj(document).ready(function() {
    if (tpj("#rev_slider_45_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_45_1");
    } else {
        revapi45 = tpj("#rev_slider_45_1").show().revolution({
            sliderType: "standard",
            jsFileLocation: "revolution/js/",
            sliderLayout: "fullscreen",
            dottedOverlay: "none",
            delay: 9000,
            navigation: {
                keyboardNavigation: "off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                mouseScrollReverse: "default",
                onHoverStop: "off",
                bullets: {
                    enable: true,
                    hide_onmobile: false,
                    style: "bullet-bar",
                    hide_onleave: false,
                    direction: "horizontal",
                    h_align: "center",
                    v_align: "bottom",
                    h_offset: 0,
                    v_offset: 50,
                    space: 5,
                    tmp: ''
                }
            },
            responsiveLevels: [1240, 1024, 778, 480],
            visibilityLevels: [1240, 1024, 778, 480],
            gridwidth: [1240, 1024, 778, 480],
            gridheight: [868, 768, 960, 720],
            lazyType: "none",
            shadow: 0,
            spinner: "off",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "off",
            fullScreenAutoWidth: "off",
            fullScreenAlignForce: "off",
            fullScreenOffsetContainer: "",
            fullScreenOffset: "0px",
            hideThumbsOnMobile: "off",
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            debugMode: false,
            fallbacks: {
                simplifyAll: "off",
                nextSlideOnWindowFocus: "off",
                disableFocusListener: false,
            }
        });
    }
    if (revapi45) revapi45.revSliderSlicey();
});
</script>
           @endpush







@endsection
