// This library need to be used before angular compile and after angular compile.
// So you should add on the index.html and inside view.htm

$(document).ready(function() {
	//Animates menu items upon homepage load
	animateHomeMenu(10);
	
	//brings in 'hi, my name is' text on page load
	$("#homeTitle").delay(3000).animate({
    left: "70px",
    opacity: "1"
	}, {
    duration: 1500, 
    easing: "swing"
	});
  /*
	//event listners trigger page transition on click of menu item
	$("#dashboard").click(function(){menuSelect(10,1, '#/app/dashboard');});
	$("#tourreport").click(function(){menuSelect(10,2, 'touringreport.html');});
  $("#tourrule").click(function(){menuSelect(10,3, 'touringrules.html');});
  $("#camera").click(function(){menuSelect(10,4, 'camera.html');});
  $("#roomaccess").click(function(){menuSelect(10,5, 'roomaccess.html');});
  $("#powermanagement").click(function(){menuSelect(10,6, 'powermanagement.html');});
  $("#intruder").click(function(){menuSelect(10,7, 'intruderalarm.html');});
  $("#sms").click(function(){menuSelect(10,8, '#');});
  $("#users").click(function(){menuSelect(10,9, 'users.html');});
  $("#settings").click(function(){menuSelect(10,10, 'settings.html');});
  */
});

function menuSelect(numCircles, circleNum, page) {
	circleName = '#circle' + circleNum;

	//fade out welcome titles
	$("#homeTitle").delay(0).animate({
	    left: "-70px",
	    opacity: "0"
	}, {
	    duration: 1500, 
	    easing: "swing"
	});
	var startPos = -380+((270/numCircles)*(circleNum-1));
	//shift other circles - then fade them away. Pass in the degs to shift by.
	closeOtherCircles(numCircles, circleName, -360-startPos);
  //resets the rotation and origin for easier positioning
	//$(circleName).toggleClass('default-origin');
	$(circleName).animateRotate(startPos, -360, 3000, 0, 'easeOutCubic', function() {});
	$('#inner'+circleNum).animateRotate(-startPos, 360, 3000, 0, 'easeOutCubic', function() {});
		
	// strip it of it's bubble
	$(circleName).delay(1500).animate({
		backgroundColor:'transparent',
		borderColor: 'transparent'		
	}, {
    duration: 1200, 
    easing: "swing"
	});
	  
	//fade out label
	$('#text'+circleNum).delay(500).animate({
		opacity: '0'
	}, {
		duration: 1200, 
	  easing: "swing"
	});

	//delay for when to change page
	setTimeout(function () {
		document.location.href = page;
	}, 2000);
}

// -------------Code snippet by yckart & drabname
//Handles rotation of html elements
$.fn.animateRotate = function(startAngle, endAngle, duration, delay, easing, complete) {
  return this.each(function() {
    var elem = $(this);
    $({deg: startAngle}).delay(delay).animate({deg: endAngle}, {
      duration: duration,
      easing: easing,
      step: function(now) {
        elem.css({
          '-moz-transform':'rotate('+now+'deg)',
          '-webkit-transform':'rotate('+now+'deg)',
          '-o-transform':'rotate('+now+'deg)',
          '-ms-transform':'rotate('+now+'deg)',
          'transform':'rotate('+now+'deg)'
        });
      },
      complete: complete || $.noop
    });
  });
};

//-------Animates home menu circles into view
function animateHomeMenu(numCircles) {
	for(i=0; i<numCircles; i++) {
  	delay = i*500;
  	$('#circle'+(i+1)).delay(delay).animate({
       opacity: '1.0',
    });
    $('#circle'+(i+1)).animateRotate(0, (-380+((360/numCircles)*i)), 3000, delay, 'easeOutCubic', function() {});

    // rotate the inner content circle in the opposite direction to stabalize content
    $('#inner'+(i+1)).animateRotate(0, -(-380+((360/numCircles)*i)), 3000, delay, 'easeOutCubic', function() {});
    
    //fade in content 
    $('#inner'+(i+1)).delay(800+(delay)).animate({
        opacity: '1.0',
    });
    // fades in text after animation
    $('#text'+(i+1)).delay(1500+(delay)).animate({
        opacity: '1.0',
    });
	}
}

//-----------Animates other menu circles out of view for when one is selected
function closeOtherCircles(numCircles, selected, shiftBy) {
	for (i=numCircles-1; 0<=i; i--) {
		if (('#circle'+(i+1))!=selected) {
    	var delay = 300/(i+1);
    	var startPos = (-380+((270/numCircles)*i));
	    $('#circle'+(i+1)).animateRotate(startPos, startPos+shiftBy, 1500, delay, 'easeOutCubic', function() {});

	    // rotate the inner content circle in the opposite direction to stabalize content
	    $('#inner'+(i+1)).animateRotate(-startPos, -(startPos+shiftBy), 1500, delay, 'easeOutCubic', function() {});
	    $('#circle'+(i+1)).delay(800).animate({
	      opacity: '0.0',
	    });
	    
	    //fade in content 
	    $('#inner'+(i+1)).delay(800).animate({
	      opacity: '0.0',
	    });
	    // fades in text after animation
	    $('#text'+(i+1)).delay(800).animate({
	      opacity: '0.0',
	    });
	  }
	}
}