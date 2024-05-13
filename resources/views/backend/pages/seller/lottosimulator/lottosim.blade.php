@extends('backend.layouts.default-dark')
@section('pageTitle', isset($pageTitle) ? app(\App\Services\TranslationService::class)->trans($pageTitle,
    app()->getLocale()) : app(\App\Services\TranslationService::class)->trans('Page title here....', app()->getLocale()))
@section('content')



<div class="content-body">
    <div class="container">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="pick-number-area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row justify-content-center mt-2">
                        @foreach($lottoNumbersList as $lottoNumbers)
                        <div class="col-lg-3 col-sm-3 col-md-4 mb-4">
                            <div class="single-pick">
                                <div class="header-area">
                                    <h4 class="title">Pick 5 Numbers</h4>
                                    <div class="buttons">
                                        <a href="#" class="custom-button1"><i class="fas fa-magic"></i>Quick Pick</a>
                                        <a href="#" class="custom-button2"><i class="fas fa-trash-alt"></i>Clear All</a>
                                    </div>
                                </div>
                                <div class="body-area">
                                    <ul>
                                        @for($i = 1; $i <= 50; $i++)
                                        <li class="{{ in_array($i, $lottoNumbers['main_numbers']) ? 'selected' : '' }}"><span class="{{ in_array($i, $lottoNumbers['main_numbers']) ? 'highlight' : '' }}">{{ $i }}</span></li>
                                        @endfor
                                    </ul>
                                    <div class="separator">
                                        <p>Pick 2 Euronumbers</p>
                                    </div>
                                    <ul>
                                        @for($i = 1; $i <= 12; $i++)
                                        <li class="{{ in_array($i, $lottoNumbers['euro_numbers']) ? 'selected' : '' }}"><span class="{{ in_array($i, $lottoNumbers['euro_numbers']) ? 'highlight' : '' }}">{{ $i }}</span></li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>









    @push('specific-css')
    @endpush

    @push('specific-scripts')
    @endpush

@endsection



<style>
.pick-number-area {
  padding: 120px 0px 105px;
}
.pick-number-area .single-pick {
  -webkit-box-shadow: 0px 5px 13px 0px rgba(40, 63, 163, 0.2);
          box-shadow: 0px 5px 13px 0px rgba(40, 63, 163, 0.2);
  border-radius: 10px;
  overflow: hidden;
}
.pick-number-area .single-pick .header-area {
  background: #fef1f1;
  padding: 10px 20px 20px;
}
.pick-number-area .single-pick .header-area .title {
  font-weight: 500;
  font-size: 18px;
  line-height: 28px;
  margin-bottom: 12px;
}
.pick-number-area .single-pick .header-area .buttons a {
  font-size: 12px;
  padding: 2px 6px;
}
.pick-number-area .single-pick .header-area .buttons a i {
  font-size: 10px;
  margin-right: 4px;
}
.pick-number-area .single-pick .body-area {
  padding: 14px 20px 14px;
}
.pick-number-area .single-pick .body-area ul li {
  display: inline-block;
}
.pick-number-area .single-pick .body-area ul li span {
  width: 30px;
  height: 30px;
  line-height: 30px;
  font-weight: 600;
  background: #ededff;
  color: #595192;
  border-radius: 50%;
  display: inline-block;
  font-size: 14px;
  cursor: pointer;
  text-align: center;

}
.pick-number-area .single-pick .body-area ul li span:hover {
  background-image: -o-linear-gradient(4deg, #ec038b 0%, #fb6468 44%, #fbb936 100%);
  background-image: linear-gradient(86deg, #ec038b 0%, #fb6468 44%, #fbb936 100%);
  -webkit-box-shadow: 0px 7px 7px 0px rgba(243, 42, 126, 0.23);
          box-shadow: 0px 7px 7px 0px rgba(243, 42, 126, 0.23);
  color: #fff;
}
.pick-number-area .single-pick .body-area .separator {
  border-top: 1px solid #c8c4e1;
  margin-top: 15px;
  padding-top: 14px;
}
.pick-number-area .single-pick .body-area .separator p {
  font-size: 18px;
  line-height: 28px;
  font-weight: 600;
  margin-bottom: 5px;
}
.pick-number-area .add-ticket-btn {
  border-radius: 10px;
  border: 1px solid #e5e7ff;
  display: inline-block;
  margin-top: 30px;
  padding: 10px 30px;
  text-transform: uppercase;
  font-weight: 600;
}
.pick-number-area .add-ticket-btn i {
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-image: -webkit-gradient(linear, left bottom, left top, from(#f4ba2e), to(#fea036));
  background-image: -o-linear-gradient(bottom, #f4ba2e 0%, #fea036 100%);
  background-image: linear-gradient(0deg, #f4ba2e 0%, #fea036 100%);
  margin-right: 10px;
}
.pick-number-area .add-ticket-btn:hover {
  background: #5949b3;
  color: #fff;
}
.pick-number-area .add-ticket-btn:hover i {
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-image: -webkit-gradient(linear, left bottom, left top, from(#fff), to(#fff));
  background-image: -o-linear-gradient(bottom, #fff 0%, #fff 100%);
  background-image: linear-gradient(0deg, #fff 0%, #fff 100%);
}
.pick-number-area .cart-summary {
  border-radius: 10px;
  background-image: -webkit-gradient(linear, left bottom, left top, from(#c165dd), to(#5c27fe));
  background-image: -o-linear-gradient(bottom, #c165dd 0%, #5c27fe 100%);
  background-image: linear-gradient(to top, #c165dd 0%, #5c27fe 100%);
  -webkit-box-shadow: 0px 26px 21px 0px rgba(43, 59, 181, 0.2);
          box-shadow: 0px 26px 21px 0px rgba(43, 59, 181, 0.2);
}
.pick-number-area .cart-summary .top-area {
  padding: 23px 20px 18px;
}
.pick-number-area .cart-summary .top-area .title {
  font-size: 24px;
  line-height: 34px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 11px;
}
.pick-number-area .cart-summary .top-area .text {
  color: #fff;
  font-size: 16px;
  line-height: 26px;
  margin-bottom: 0px;
}
.pick-number-area .cart-summary .middle-area {
  background: rgba(255, 255, 255, 0.2);
  padding: 15px 20px 15px;
}
.pick-number-area .cart-summary .middle-area .tikit {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  -ms-flex-item-align: center;
      -ms-grid-row-align: center;
      align-self: center;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  margin-bottom: 7px;
}
.pick-number-area .cart-summary .middle-area .tikit .left {
  color: #fff;
  font-size: 16px;
  line-height: 26px;
}
.pick-number-area .cart-summary .middle-area .tikit .right {
  color: #fff;
  font-size: 20px;
  line-height: 30px;
  font-weight: 700;
}
.pick-number-area .cart-summary .middle-area .price {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  -ms-flex-item-align: center;
      -ms-grid-row-align: center;
      align-self: center;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
}
.pick-number-area .cart-summary .middle-area .price .left {
  color: #fff;
  font-size: 16px;
  line-height: 26px;
  text-align: left;
}
.pick-number-area .cart-summary .middle-area .price .left small {
  display: block;
  margin-top: -3px;
  color: #24e980;
}
.pick-number-area .cart-summary .middle-area .price .right {
  color: #fff;
  font-size: 20px;
  line-height: 30px;
  font-weight: 700;
}
.pick-number-area .cart-summary .bottom-area {
  padding: 15px 20px 30px;
}
.pick-number-area .cart-summary .bottom-area .total-area {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  font-size: 20px;
  line-height: 30px;
  color: #fff;
  font-weight: 700;
}
.pick-number-area .cart-summary .bottom-area .custom-button2 {
  margin-top: 22px;
}


.custom-button1 {
    background-image: -o-linear-gradient(83deg, #ec1379 0%, #6c0092 100%);
    background-image: linear-gradient(7deg, #ec1379 0%, #6c0092 100%);
    border: 1px solid #6c0092;
    border-radius: 5px;
    -webkit-box-shadow: 0px 3px 2px 0px rgba(32, 29, 30, 0.25);
    box-shadow: 0px 3px 2px 0px rgba(32, 29, 30, 0.25);
    padding: 5px 10px;
    font-size: 16px;
    line-height: 26px;
    color: #ffffff;
    display: inline-block;
    cursor: pointer;
    width: auto;
    height: auto;
    display: none;
}

.custom-button2 {
    background-image: -o-linear-gradient(83deg, #ec1379 0%, #6c0092 100%);
    background-image: linear-gradient(7deg, #ec1379 0%, #6c0092 100%);
    border: 1px solid #6c0092;
    border-radius: 5px;
    -webkit-box-shadow: 0px 3px 2px 0px rgba(32, 29, 30, 0.25);
    box-shadow: 0px 3px 2px 0px rgba(32, 29, 30, 0.25);
    padding: 5px 10px;
    font-size: 16px;
    line-height: 26px;
    color: #ffffff;
    display: inline-block;
    cursor: pointer;
    width: auto;
    height: auto;
    display: none;
}


.pick-number-area .single-pick .body-area ul li span.highlight {
    /* Hervorhebungsstil hier hinzufügen */
    background-color: #ffcc00; /* Gelber Hintergrund */
    color: #000; /* Schwarzer Text */
    font-weight: bold; /* Fettschrift */
}

</style>
