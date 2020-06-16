/*Dashboard Init*/
/*Dashboard Init*/
 
"use strict"; 
$(document).ready(function() {
	/*Toaster Alert*/
	$.toast({
		heading: '¡Bienvenido Estimado(a) Usuario(a)!',
		text: '<span style="font-size: 3.3rem; display: block; text-align: center"><i class="fa fa-user"></i></span><p>Le damos una cordial bienvenida, ha iniciado sesi&oacute;n con &eacute;xito!</p>',
		position: 'top-right',
		loaderBg:'#ab26aa',
		class: 'jq-toast-primary',
		hideAfter: 3500, 
		stack: 6,
		showHideTransition: 'fade'
	});
	if($('#area_chart').length > 0) {
		var data=[{
            period: 'Son',
            iphone: 10,
            ipad: 80,
        }, {
            period: 'Mon',
            iphone: 130,
            ipad: 100,
        }, {
            period: 'Tue',
            iphone: 80,
            ipad: 30,
        }, {
            period: 'Wed',
            iphone: 70,
            ipad: 200,
        }, {
            period: 'Thu',
            iphone: 180,
            ipad: 50,
        }, {
            period: 'Fri',
            iphone: 105,
            ipad: 170,
        },
         {
            period: 'Sat',
            iphone: 250,
            ipad: 150,
        }];
		
		var lineChart = Morris.Area({
        element: 'area_chart',
        data: data ,
        xkey: 'period',
        ykeys: ['iphone', 'ipad'],
        labels: ['iphone', 'ipad'],
        pointSize: 0,
        lineWidth:0,
		fillOpacity: 0.95,
		pointStrokeColors:['#97ca5a','#ab26aa'],
		behaveLikeLine: true,
		grid: false,
		hideHover: 'auto',
		lineColors: ['#97ca5a','#ab26aa'],
		resize: true,
		redraw: true,
		smooth: true,
		gridTextColor:'#878787',
		gridTextFamily:"Nunito",
        parseTime: false
    });
	}
	if( $('#m_chart_4').length > 0 ){
		// Line Chart
		var data=[{ y: '2014', a: 75604, b: 71528, c: 64076},
				  { y: '2015', a: 45604, b: 45000, c: 604},
				  { y: '2016', a: 75604, b: 75255, c: 349},
				  { y: '2017', a: 195604, b: 193455, c: 2149},
				  { y: '2018', a: 525604, b: 459259, c: 66345},
				  { y: '2019', a: 410564, b: 310564, c: 12611},
				];
		var lineChart = Morris.Line({
				element: 'm_chart_4',
				data: data,
				xkey: 'y',
				ykeys: ['a', 'b', 'c'],
				labels: ['Total de Casos','Casos Procesados','Casos Rechazados'],
				gridLineColor: 'transparent',
				resize: true,
				gridTextColor:'#6f7a7f',
				gridTextFamily:"Inherit",
				hideHover: 'auto',
				behaveLikeLine: true,
				smooth:false,
				pointSize:4,
				lineWidth:2,
				pointFillColors:['#fff','#fff','#fff'],
				pointStrokeColors: ['#ab26aa','#00b894','#d63031'],
				lineColors: ['#ab26aa','#00b894','#d63031'],
			});	
	}

	
});

/*****E-Charts function start*****/
var echartsConfig = function() { 
	if( $('#e_chart_1').length > 0 ){
		var eChart_1 = echarts.init(document.getElementById('e_chart_1'));
		var option = {
			tooltip: {
				show: true,
				backgroundColor: '#fff',
				borderRadius:6,
				padding:7,
				axisPointer:{
					lineStyle:{
						width:0,
					}
				},
				textStyle: {
					color: '#00b894',
					fontFamily: '"Poppins", sans-serif',
					fontSize: 16
				}	
			},
			series: [
				{
					type: 'pie',
					selectedMode: 'single',
					radius: ['90%', '50%'],
					labelLine: {
						normal: {
							show: false
						}
					},
					color: ['#0984e3', '#b2bec3'],
					data:[
						{value:45048, name:''},
						{value:86780, name:''},
					]
				}
			]
		};
		eChart_1.setOption(option);
		eChart_1.resize();
	}
	
	if( $('#e_chart_3').length > 0 ){
		var eChart_3 = echarts.init(document.getElementById('e_chart_3'));
		var option2 = {
			color: ['#ab26aa', '#bdbdbd','#cecece','#ab26aa','#e2e2e2'],		
			tooltip: {
				show: true,
				trigger: 'axis',
				backgroundColor: '#fff',
				borderRadius:8,
				padding:8,
				axisPointer:{
					lineStyle:{
						width:0,
					}
				},
				textStyle: {
					color: '#324148',
					fontFamily: '"Nunito", sans-serif',
					fontSize: 14
				}	
			},
			
			grid: {
				top: '3%',
				left: '3%',
				right: '3%',
				bottom: '3%',
				containLabel: true
			},
			xAxis : [
				{
					type : 'category',
					data : ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio'],
					axisLine: {
						show:true
					},
					axisTick: {
						show:true
					},
					axisLabel: {
						textStyle: {
							color: '#5e7d8a'
						}
					}
				}
			],
			yAxis : [
				{
					type : 'value',
					axisLine: {
						show:false
					},
					axisTick: {
						show:false
					},
					axisLabel: {
						textStyle: {
							color: '#5e7d8a'
						}
					},
					splitLine: {
						lineStyle: {
							color: '#eee',
						}
					}
				}
			],
			series : [
				{
					name:'1',
					type:'bar',
					stack: 'st1',
					barMaxWidth: 40,
					data:[21200,31454,64565,86780,45048,0,0],
				},
			]
		};

		eChart_3.setOption(option2);
		eChart_3.resize();
	}
	
	if( $('#e_chart_4').length > 0 ){
		var eChart_4 = echarts.init(document.getElementById('e_chart_4'));
		var option4 = {
			timeline: {
				data: ['91', '92', '93', '94', '95', '96', '97', '98', '99', '91'],
				axisType: 'category',
				show: false,
				playInterval: 1000,
			},
			options: [{
				tooltip: {
					show: true,
					trigger: 'axis',
					backgroundColor: '#fff',
					borderRadius:6,
					padding:6,
					axisPointer:{
						lineStyle:{
							width:0,
						}
					},
					textStyle: {
						color: '#324148',
						fontFamily: '"Nunito", sans-serif',
						fontSize: 12
					}	
				},
				calculable: true,
				grid: {
					top: '3%',
					left: '3%',
					right: '3%',
					bottom: '3%',
					containLabel: true
				},
				xAxis: [{
					'type': 'category',
					axisLabel: {
						textStyle: {
							color: '#324148',
							fontFamily: '"Nunito", sans-serif',
							fontSize: 12
						}	
					},
					axisLine: {
						show:false
					},
					splitLine:{
						show:false
					},
					'data': [
						'x1', ' x2', 'x3', 'x4', 'x5', 'x6', 'x7', 'x8'
					]
				}],
				yAxis: [{
					type: 'value',
					axisLine: {
						show:false
					},
					axisTick: {
						show:false
					},
					axisLabel: {
						textStyle: {
							color: '#5e7d8a'
						}
					},
					splitLine: {
						lineStyle: {
							color: '#eee',
						}
					}
				}, {
					type: 'value',
					axisLine: {
						show:false
					},
					axisTick: {
						show:false
					},
					axisLabel: {
						textStyle: {
							color: '#5e7d8a'
						}
					},
					splitLine: {
						lineStyle: {
							color: '#eee',
						}
					}
				}],
				series: [{
					'name': 'tq',
					'yAxisIndex': 1,
					'type': 'line',
					'data': [10, 28, 20, 28, 24, 24, 24, 10],
					symbolSize: 10,
					lineStyle: {
						width:3,
					},
					itemStyle: {
						normal: {
							color: '#ab26aa',
						}
					},
					areaStyle: {
						normal: {
							color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
								offset: 0,
								color: '#ab26aa'
							}, {
								offset: 1,
								color: '#fff'
							}])
						}
					},
					label: {
						normal: {
							show: true,
							position: 'top',
							formatter: '{c}',
							color: '#5e7d8a',
							fontStyle: 'normal',
							fontWeight: 'normal',
							fontFamily: "inherit",
							fontSize: 12
						}
					},
				}]
			}]
		};
		eChart_4.setOption(option4);
		eChart_4.resize();
	}
	
}
/*****E-Charts function end*****/

var sparklineLogin = function() { 
	if( $('#sparkline_1').length > 0 ){
		$("#sparkline_1").sparkline([2,4,4,6,8,5,6,4,8,6,6,2 ], {
			type: 'bar',
			width: '100%',
			height: '40',
			barWidth: '5',
			resize: true,
			barSpacing: '5',
			barColor: '#ab26aa',	
			highlightSpotColor: '#ab26aa'
		});
	}	
	if( $('#sparkline_2').length > 0 ){
		$("#sparkline_2").sparkline([2,7,7,5,8,5,4,4,3,4,6,1 ], {
			type: 'bar',
			width: '100%',
			height: '40',
			barWidth: '5',
			resize: true,
			barSpacing: '5',
			barColor: '#ab26aa',	
			highlightSpotColor: '#ab26aa'
		});
	}	
	if( $('#sparkline_3').length > 0 ){
		$("#sparkline_3").sparkline([9,3,3,2,8,6,4,3,3,2,6,1 ], {
			type: 'bar',
			width: '100%',
			height: '40',
			barWidth: '5',
			resize: true,
			barSpacing: '5',
			barColor: '#ab26aa',	
			highlightSpotColor: '#ab26aa'
		});
	}
	if( $('#sparkline_4').length > 0 ){
		$("#sparkline_4").sparkline([5,3,3,2,1,6,2,3,5,2,2,1 ], {
			type: 'bar',
			width: '100%',
			height: '40',
			barWidth: '5',
			resize: true,
			barSpacing: '5',
			barColor: '#ab26aa',	
			highlightSpotColor: '#ab26aa'
		});
	}
}
sparklineLogin();

/*****Resize function start*****/
var sparkResize,echartResize;
$(window).on("resize", function () {
	/*Sparkline Resize*/
	clearTimeout(sparkResize);
	sparkResize = setTimeout(sparklineLogin, 200);
	
	/*E-Chart Resize*/
	clearTimeout(echartResize);
	echartResize = setTimeout(echartsConfig, 200);
}).resize(); 
/*****Resize function end*****/

/*****Function Call start*****/
echartsConfig();
/*****Function Call end*****/