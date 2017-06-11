/*ANIMACION LOGO*/

function basura(){
    var s = Snap("#svg");
    Snap.load("../logo.svg", function (f) {
        g = f.select("g");
        tapa1 = f.select("#tapa1");
        tapa2 = f.select("#tapa2");
        
        s.hover( 
            function () {
                tapa1.animate({
                       
                        y:725.7904
                    }, 600, mina.elastic)

            },
            function () {
                tapa1.animate({
                       
                        y:743.64795
                    }, 600, mina.elastic)
            });
        
        s.hover( 
            function () {
                tapa2.animate({
                       
                        y:708.07648
                    }, 600, mina.elastic)

            },
            function () {
                tapa2.animate({
                       
                        y:726.07648
                    }, 600, mina.elastic)
            });

        s.append(g);
    });
}
