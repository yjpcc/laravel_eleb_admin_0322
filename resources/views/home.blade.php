@extends("default")
@section("content")
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            <li data-target="#carousel-example-generic" data-slide-to="4"></li>
            <li data-target="#carousel-example-generic" data-slide-to="5"></li>
            <li data-target="#carousel-example-generic" data-slide-to="6"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active" style="height: 580px">
                <img src="/img/1.jpg" alt="...">
                <div class="carousel-caption">
                    不管前方的路有多苦，只要走的方向正确，不管多么崎岖不平，都比站在原地更接近幸福.
                </div>
            </div>
            <div class="item" style="height: 580px">
                <img src="/img/2.jpg" alt="...">
                <div class="carousel-caption">
                    当你在走一条自己的路的时候，人们往往说你走错路了。
                </div>
            </div>

            <div class="item" style="height: 580px">
                <img src="/img/view6.jpg" alt="...">
                <div class="carousel-caption">
                    我们要么使自己痛苦不堪，要么使自己强大无比，而这两者所需要付出的代价是差不多的。与其祈求生活平淡点，还不如祈求自己强大点。
                </div>
            </div>

            <div class="item" style="height: 580px">
                <img src="/img/view7.jpg" alt="...">
                <div class="carousel-caption">
                    有时候，坚持了你最不想干的事情之后，便可得到你最想要的东西。
                </div>
            </div>

            <div class="item" style="height: 580px">
                <img src="/img/view8.jpg" alt="...">
                <div class="carousel-caption">
                    月伴星，星傍月，繁星闪闪，月痴迷。 花醉蝶，蝶恋花，蝶舞翩翩，花嫣然。
                </div>
            </div>

            <div class="item" style="height: 580px">
                <img src="/img/view9.jpg" alt="...">
                <div class="carousel-caption">
                    我给你一颗糖，你看到我给别人两颗，你就对我有看法了，但你不知道他也曾给我两颗糖，而你什么都没给过我…
                </div>
            </div>
            <div class="item" style="height: 580px">
                <img src="/img/view10.jpg" alt="...">
                <div class="carousel-caption">
                    每当无能为力的时候，我们就爱说顺其自然。
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endsection