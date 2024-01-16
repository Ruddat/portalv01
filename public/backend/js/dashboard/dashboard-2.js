

(function($) {
    /* "use strict" */
	
 var dlabChartlist = function(){
	
	var screenWidth = $(window).width();
	//let draw = Chart.controllers.line.__super__.draw; //draw shadow
	
	var redial = function() {
		var options = {
			series: [70],
			chart: {
				type: 'radialBar',
				offsetY: 0,
				height:160,
				sparkline: {
					enabled: true
				}
			},
			plotOptions: {
				radialBar: {
					startAngle: -90,
					endAngle: 90,
					track: {
						background: "#DBDBDB",
						strokeWidth: '100%',
						margin: 2,
					},
					hollow: {
						margin: 50,
						size: '+70%',
						//background: 'white',
						//position: 'front',
					},
					dataLabels: {
						name: {
							show: false
						},
						value: {
							offsetY: -10,
							fontSize: '18px',
							color: '#33A9FF',
							fontWeight: 600,
						}
					}
				}
			},
			grid: {
				padding: {
					top: -10
				}
			},
			fill: {
				type: 'gradient',
				colors: '#33A9FF',
				gradient: {
					shade: 'white',
					shadeIntensity: 0.15,
					inverseColors: false,
					opacityFrom: 1,
					opacityTo: 1,
					stops: [0, 50, 65, 91]
				},
			},
			labels: ['Average Results'],
			responsive: [{
				breakpoint: 1750,
				options: {
					chart: {
						height: 160
					},
				}
				
				
			}],
			
		};
		var chart = new ApexCharts(document.querySelector("#redial"), options);
		chart.render();
	}
	var piechart = function(){
		 var options = {
			  series: [45, 10, 80, ],
			  chart: {
			  type: 'donut',
			  height:250,
			},
			dataLabels: {
				enabled: false
			},
			legend: {
				
				show:false
			},
			stroke: {
				
				width:0,
			},
			fill: {
				colors: ['var(--primary)', '#1FBF75' ,'#33A9FF'],
			},
			responsive: [{
			  breakpoint: 601,
			  options: {
				chart: {
				  width: 200,
				  height: 200
				},
				legend: {
				  position: 'bottom'
				}
			  },
			  breakpoint:361,
			  options: {
				chart: {
				  width: 270,
				  height: 200
				  
				},
				legend: {
				  position: 'bottom'
				}
			  }
			 
			}]
			};

			var piechart = new ApexCharts(document.querySelector("#piechart"), options);
			piechart.render();
	}
	var peityLine = function(){
		$(".peity-line").peity("line", {
			fill: ["rgba(254, 198, 79, 0.15)"], 
			stroke: '#fff', 
			strokeWidth: '4', 
			width: "100%",
			radius: 8,
			height: "140",
			//curve: 'rounded',
			
		});
	}
	var activityz = function(){
		var optionsArea = {
          series: [{
            name: "",
            data: [80, 55, 50, 40, 75, 80, 40, 55, 50, 40, 75, 80]
          },
		  {
            name: "",
            data: [75, 25, 60, 25, 15, 70,75, 25, 60, 25, 15, 70]
          }
        ],
          chart: {
          height: 300,
          type: 'area',
		  group: 'social',
		  toolbar: {
            show: false
          },
          zoom: {
            enabled: false
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: [3, 3, 3],
		  colors:['#4CBC9A','#FF6A59'],
		  curve: 'smooth'
        },
        legend: {
			show:false,
          tooltipHoverFormatter: function(val, opts) {
            return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
          },
		  markers: {
			fillColors:['#C046D3','#FF6A59','#FF9432'],
			width: 16,
			height: 16,
			strokeWidth: 0,
			radius: 16
		  }
        },
    
        xaxis: {
        categories: ['1', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		  labels: {
		   style: {
			  colors: '#3E4954',
			  fontSize: '14px',
			   fontFamily: 'Poppins',
			  fontWeight: 100,
			  
			},
		  },
		  axisBorder:{
			  show: false
		  },
		  axisTicks: {
			  
			show:false,  
		  },
        },
		yaxis: {
			labels: {
			offsetX:-16,
			minWidth:40,
			style: {
			  colors: '#3E4954',
			  fontSize: '14px',
			   fontFamily: 'Poppins',
			  fontWeight: 100,
			  
			},
		  },
		   axisTicks: {
			  show: false,
			  borderType: 'solid',
			  color: '#78909C',
			  width: 6,
			  offsetX: 0,
			  offsetY: 0
			},
		},
		fill: {
			colors:['#fff','#FF9432'],
			type:'gradient',
			opacity: 1,
			gradient: {
				shade:'light',
				shadeIntensity: 1,
				colorStops: [ 
				  [
					{
					  offset: 0,
					  color: '#4CBC9A',
					  opacity: .4
					},
					{
					  offset: 0.6,
					  color: '#4CBC9A',
					  opacity: .4
					},
					{
					   offset: 100,
					  color: '#fff',
					  opacity: 0.4
					}
				  ],
				  [
					{
					  offset: 0,
					  color: '#FEC64F',
					  opacity: .28
					},
					{
					  offset: 50,
					  color: '#FEC64F',
					  opacity: 0.25
					},
					{
					  offset: 100,
					  color: '#fff',
					  opacity: 0.4
					}
				  ]
				]

		  },
		},
		colors:['#1EA7C5','#FF9432'],
        grid: {
          borderColor: '#f1f1f1',
		  xaxis: {
            lines: {
              show: true
            }
          },
		  yaxis: {
            lines: {
              show: false
            }
          },
        },
		 responsive: [{
			breakpoint: 575,
			options: {
				markers: {
					 size: [6,6,4],
					 hover: {
						size: 7,
					  }
				}
			}
		 }]
        };
		var chartArea = new ApexCharts(document.querySelector("#activityz"), optionsArea);
        chartArea.render();

	}
	
	var chartBar5 = function(){
		var options = {
			  series: [
				{
					name: '',
					data: [120, 90, 70, 40,50, 18, 70, 90,70, 40,50, 18],
					//radius: 12,	
				}, 
				{
				  name: '',
				  data: [75,50, 18, 70, 40,70, 100,50, 18, 40, 55, 100]
				}, 
				
			],
			chart: {
				type: 'bar',
				height: 280,
				
				toolbar: {
					show: false,
				},
				
			},
			plotOptions: {
			  bar: {
				horizontal: false,
				columnWidth: '35%',
				endingShape: "rounded",
				borderRadius: 2,
			  },
			  
			},
			states: {
			  hover: {
				filter: 'none',
			  }
			},
			colors:['#1FBF75', 'var(--primary)'],
			dataLabels: {
			  enabled: false,
			},
			markers: {
				shape: "circle",
			},
		
		
			legend: {
				show: false,
				fontSize: '14px',
				position: 'top',
				labels: {
					colors: '#000000',
					
					},
				markers: {
				width: 18,
				height: 18,
				strokeWidth:50,
				strokeColor: '#fff',
				fillColors: undefined,
				radius: 12,	
				}
			},
			stroke: {
			  show: true,
			  width:3,
			  curve: 'smooth',
			  lineCap: 'round',
			  colors: ['transparent']
			},
			grid: {
				borderColor: '#eee',
			},
			xaxis: {
				position: 'bottom',
				  categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				  labels: {
				   show: true,
				   style: {
					  colors: '#999999',
					  fontSize: '14px',
					  fontFamily: 'poppins',
					  fontWeight: 400,
					  cssClass: 'apexcharts-xaxis-label',
					},
				  },
				   axisBorder:{
					 show: false,  
					   
					},
					axisTicks: {
						show:false
						
					},
				  crosshairs: {
				  show: false,
			  }
			},
			yaxis: {
				labels: {
					offsetX:-16,
				   style: {
					  colors: '#787878',
					  fontSize: '13px',
					   fontFamily: 'poppins',
					  fontWeight: 100,
					  cssClass: 'apexcharts-xaxis-label',
				  },
			  },
			},
			fill: {
			  opacity: 1,
			  colors:['#1FBF75', 'var(--primary)'],
			},
			tooltip: {
			  y: {
				formatter: function (val) {
				  return " " + val + ""
				}
			  }
			},
			responsive: [{
				breakpoint: 575,
				options: {
					series: [
						{
							name: '',
							data: [120, 90, 70],
							//radius: 12,	
						}, 
						{
						  name: '',
						  data: [75,50, 18]
						}, 
						
					],
					plotOptions: {
					  bar: {	
						columnWidth: '70%',
					  },
					  
					},
					xaxis:{
						categories: ['Jan', 'Feb', 'Mar'],
					}
					
				}
			}]
		};

		var chartBar5 = new ApexCharts(document.querySelector("#chartBar5"), options);
		chartBar5.render();
	}
	var activeUser = function() {
			if(jQuery('#activeUser').length > 0) {
				var data = {
					labels: ["00:00", "", "", "", "", "", "", "", "", "23:59"],
					datasets: [{
						label: "My First dataset",
						backgroundColor: "#fc8019",
						//strokeColor: "rgba(255,255,255,0.3)",
						pointColor: "rgba(0,0,0,0)",
						//pointStrokeColor: "rgba(58,223,174,1)",
						//pointHighlightFill: "rgba(58,223,174,1)",
						//pointHighlightStroke: "rgba(58,223,174,1)",
						borderCapStyle: 'round',
						data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80]
					}]
				};
				var ctx = document.getElementById("activeUser").getContext("2d");
				var chart = new Chart(ctx, {
					type: "bar",
					data: data,
					
					options: {
						responsive: !0,
						maintainAspectRatio: false,
						plugins:{
								legend:false
							
						},
						
						tooltips: {
							enabled: false
						},
						scales: {
							x: {
								display: !1,
								gridLines: {
									display: !1
								},
								barPercentage: 1,
								categoryPercentage: 0.5
							},
							y: {
								display: !1,
								ticks: {
									padding: 10,
									stepSize: 20,
									max: 100,
									min: 0
								},
								gridLines: {
									display: !0,
									drawBorder: !1,
									lineWidth: 1,
									zeroLineColor: "rgba(255,255,255.0.1)",
								}
							}
						}
					}
				});
				setInterval(function() {
					chart.config.data.datasets[0].data.push(Math.floor(10 + Math.random() * 80));
					chart.config.data.datasets[0].data.shift();
					chart.update();
				}, 2000);
			}
	}
	


	
	

	
 
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				//chartBar();
				//chartBar1();
				redial();
				//chartBar2();
				piechart();
				peityLine();
				activityz();
				//chartBar3();
				//chartBar4();
				chartBar5();
				activeUser();
				
				
				
			},
			
			resize:function(){
				chartBar5();
			}
		}
	
	}();

	
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dlabChartlist.load();
		}, 1000); 
		
	});

     

})(jQuery);