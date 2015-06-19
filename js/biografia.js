jQuery(document).ready(function(){
        if(ScreenType=="MD" || ScreenType=="LG"){
            jQuery(".leaves-right").octoberLeaves({
            leafStyles: 1,      // Number of leaf styles in the sprite (leaves.png)
            speedC: 0.5,  // Speed of leaves
            rotation: 1,// Define rotation of leaves
            rotationTrue: 0,    // Whether leaves rotate (1) or not (0)
            numberOfLeaves: 5, // Number of leaves
            size: 20,   // General size of leaves, final size is calculated randomly (with this number as general parameter)
            cycleSpeed: 100,      // <a href="http://www.jqueryscript.net/animation/">Animation</a> speed (Inverse frames per second) (10-100)
            container:".leaves-right"
            });
        }
    });