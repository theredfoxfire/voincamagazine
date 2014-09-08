$(window).load(function() {
				$('.slider')._TMS({
					duration:800,
					easing:'easeOutQuart',
					preset:'diagonalExpand',
					slideshow:7000,
					pagNums:false,
					pagination:'.pagination',
					banners:'fade',
					pauseOnHover:true,
					waitBannerAnimation:true
				});
			});
