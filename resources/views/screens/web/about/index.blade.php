@extends('layout.web.app')

@section('content')
<section class="about-sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="inner-banner-hd">About Us</h2>
            </div>
        </div>
    </div>
</section>
<section class="about-sec-content fix-pading">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-6 col-12">
                <div>
                    <img class="img-fluid" src="{{ asset('assets/web/images/aboutImg.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-7 col-md-6 col-12">
                <div class="about-content">
                    <h3 class="section-hd-secondary">About Gold Depot Store</h3>
                    <p class="para mb-4"><strong>Gold Depot Store</strong>  is an online bullion exchange. Working with retail customers in the U.S., it buys and sells gold, silver, copper, palladium, platinum, and rhodium. Clients can also store their gold and silver, invest through IRAs, or borrow against their metals. The online bullion dealer also publishes news and analysis about the precious metals markets and promotes sound money public policy</p>
                    <p class="para mb-4">Now you can safeguard your assets from financial turmoil and the devaluing dollar - without paying costly middleman mark-ups or fending off high pressure, bait-and-switch sales tactics. Savvy, self-reliant investors are embracing <strong>Gold Depot Store</strong> as their trustworthy resource for gold and silver bullion.</p>
                    <p class="para">The reasons for the company's rapid growth and stellar reputation and are simple and straightforward - <strong>Gold Depot Store</strong> is discreet, dependable, and extremely competitive on pricing. Investopedia recently named <strong>Gold Depot Store</strong> as the "Best Overall" precious metals dealer on the Internet in recognition of its high integrity, value pricing wide array of services, and beginner friendly approach focusing on educating customers and giving them white- glove service regardless of their order sizes.</p>
                </div>
            </div>
        </div>
         <div class="row  mt-5">
            <div class="col-lg-10 col-md-9 col-12">
                <div class="about-content">
                    <h3 class="section-hd-secondary">Kevin McNerney Chief Executive Officer</h3>
                    <p class="para mb-4">Kevin McNerney is CEO of <strong>Gold Depot Store</strong> , a national precious metals investment company and news service with over one million readers and 500,000 customers. He launched the company while president of a national newsletter publishing company dedicated to helping subscribers protect their freedoms, assets, and privacy.</p>
                    <p class="para mb-4">Kevin McNerney founded <strong>Gold Depot Store</strong> in 2010 in direct response to the abusive methods of national advertisers of "rare," collectible, and numismatic coins who mark up their coins to 50%, 100%, or even higher above their actual melt value. <strong>Gold Depot Store</strong> believes the average investor should never purchase precious metals that are not priced near their actual melt value. The rare coin market is only suitable for highly experienced collectors with money to blow</p>
                    <p class="para mb-4">Kevin McNerney also leads marketing, publishing, and real estate holding companies as well as legislative projects involving sound money and the precious metals industry. Previously, Kevin McNerney served as Vice President of the National Right to Work Legal Defense Foundation in Springfield, Virginia. Kevin McNerney is a graduate of the University of Florida with a BA degree in Political Science.</p>
                    <p class="para">Kevin McNerney is a seasoned business leader, investor, and political strategist, with appearances on U.S. television networks such as CNN, FoxNews, Fox Business, and CNBC. He is also a regular columnist for Seeking Alpha and Investing.com and has been published by the Wall Street Journal, Newsweek, Mining.com, and TheStreet, among thousands of other national, state, and local newspapers, wire services, and Internet sites.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-12">
                 <div>
                    <img class="img-fluid" src="{{ asset('assets/web/images/aboutImg.png') }}" alt="">
                </div>
            </div>

             <div class="row  mt-5">
                <div class="col-lg-10 col-md-9 col-12">
                    <div class="about-content">
                        <h3 class="section-hd-secondary">Dean Spitaleri — Director</h3>
                        <p class="para mb-4">In addition to playing a leading editorial role, Spitaleri works closely with CEO  Kevin McNerney and oversees core company operations, internal systems, employee training, loan underwriting, and AML/BSA and other compliance matters.  He writes extensively on the precious metals markets and on the issue of sound money.</p>
                        <p class="para mb-4">Spitaleri grew up in rural Oregon and attended Linfield College, where he graduated Magna Cum Laude with a degree in business. After college, Spitaleri joined a steel distributor offering specialty steel tubing and bar. Spitaleri spent 11 years helping build Team Tube into a regional firm with locations up and down the West Coast. He served as General Manager of the firm's California business operations.</p>
                        <p class="para mb-4">Spitaleri relocated his family to Idaho to enjoy a higher quality of life and ultimately to build a business around the issues he cares most deeply about. Spitaleri joined with Kevin McNerney to launch <strong>Gold Depot Store</strong> in 2010.</p>
                    </div>
                </div>
            <div class="col-lg-2 col-md-3 col-12">
                 <div>
                    <img class="img-fluid" src="{{ asset('assets/web/images/aboutImg.png') }}" alt="">
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="about-dollar-area">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-md-11 col-12">
                <div class="dollar-sec">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="dollar-img-area">
                                    <img class="img-fluid" src="{{ asset('assets/web/images/dollar2.png') }}" alt="">
                                    <img class="img-fluid" src="{{ asset('assets/web/images/dollar1.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="dollar-content">
                                    <h3 class="dollar-hd">Home of the Morgan
                                        Dollar Deal!</h3>
                                    <h4 class="dollar-hd-inner">Any Quantity Only $49.99/oz Over Spot</h4>
                                    <p class="para white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                        do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    <div class="mt-4">
                                        <a href="#" class="primary-btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</section>
<section class="logo-sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div>
                    <img class="img-fluid" src="{{ asset('assets/web/images/logo1.png') }}" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="news-area">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-7 col-12">
                            <h4 class="news-hd">Subscribe To Our Email</h4>
                            <h5 class="latest-hd">For Latest News & Updates</h5>
                            <p class="para news-para">There are many variations of passages of Lorem Ipsum available but
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-5 col-12">
                            <form action="" class="news-later-form">
                                <input type="text" placeholder="Enter Your Email Address" class="input-form">
                                <button class="primary-btn mt-5">Submit Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
