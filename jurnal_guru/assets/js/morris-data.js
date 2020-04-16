// Dashboard 1 Morris-chart
$(function () {
    "use strict";
    var ipserver = "http://localhost/peminjamanberkas/";
    $.ajax({
        type : "post",
        url   : "http://localhost/peminjamanberkas/peminjaman/getdataapi",
        async : false,
        dataType : 'json',
        data: {
        tipe:'1'
        },
        success : function(dataku){
            console.log("data 1 "+dataku);
            Morris.Area({
                element: 'morris-area-chart',
                data: dataku,
                xkey: 'namapoli',
                ykeys: ['jumlahtelat'],
                labels: ['jumlahtelat'],
                pointSize: 3,
                fillOpacity: 0,
                pointStrokeColors:['#009efb'],
                behaveLikeLine: true,
                gridLineColor: '#e0e0e0',
                lineWidth: 3,
                hideHover: 'auto',
                lineColors: ['#009efb'],
                resize: true
                
            });
        }

    });
   
//     $.ajax({
//         type : "post",
//         url   : "http://localhost/peminjamanberkas/peminjaman/getdataapi",
//         async : false,
//         dataType : 'json',
//         data: {
//         tipe:'2'
//         },
//         success : function(dataku){
//             Morris.Area({
//                 element: 'chart-bangsal',
//                 data: dataku,
//                 xkey: 'namapoli',
//                 ykeys: ['jumlahtelat'],
//                 labels: ['jumlahtelat'],
//                 pointSize: 3,
//                 fillOpacity: 0,
//                 pointStrokeColors:['#009efb'],
//                 behaveLikeLine: true,
//                 gridLineColor: '#e0e0e0',
//                 lineWidth: 3,
//                 hideHover: 'auto',
//                 lineColors: ['#009efb'],
//                 resize: true
                
//             });
//         }

//     });
// Morris.Area({
//         element: 'morris-area-chart2',
//         data: [{
//             period: '2010',
//             SiteA: 0,
//             SiteB: 0,
            
//         }, {
//             period: '2011',
//             SiteA: 130,
//             SiteB: 100,
            
//         }, {
//             period: '2012',
//             SiteA: 80,
//             SiteB: 60,
            
//         }, {
//             period: '2013',
//             SiteA: 70,
//             SiteB: 200,
            
//         }, {
//             period: '2014',
//             SiteA: 180,
//             SiteB: 150,
            
//         }, {
//             period: '2015',
//             SiteA: 105,
//             SiteB: 90,
            
//         },
//          {
//             period: '2016',
//             SiteA: 250,
//             SiteB: 150,
           
//         }],
//         xkey: 'period',
//         ykeys: ['SiteA', 'SiteB'],
//         labels: ['Site A', 'Site B'],
//         pointSize: 0,
//         fillOpacity: 0.4,
//         pointStrokeColors:['#b4becb', '#009efb'],
//         behaveLikeLine: true,
//         gridLineColor: '#e0e0e0',
//         lineWidth: 0,
//         smooth: false,
//         hideHover: 'auto',
//         lineColors: ['#b4becb', '#009efb'],
//         resize: true
        
//     });


// LINE CHART
        var line = new Morris.Line({
          element: 'morris-line-chart',
          resize: true,
          data: [
            {y: '2011 Q1', item1: 2666},
            {y: '2011 Q2', item1: 2778},
            {y: '2011 Q3', item1: 4912},
            {y: '2011 Q4', item1: 3767},
            {y: '2012 Q1', item1: 6810},
            {y: '2012 Q2', item1: 5670},
            {y: '2012 Q3', item1: 4820},
            {y: '2012 Q4', item1: 15073},
            {y: '2013 Q1', item1: 10687},
            {y: '2013 Q2', item1: 8432}
          ],
          xkey: 'y',
          ykeys: ['item1'],
          labels: ['Item 1'],
          gridLineColor: '#eef0f2',
          lineColors: ['#009efb'],
          lineWidth: 1,
          hideHover: 'auto'
        });
 // Morris donut chart
        
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12,

        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true,
        colors:['#009efb', '#55ce63', '#2f3d4a']
    });

// Morris bar chart
// $.ajax({
//     type : "post",
//     url   : "http://localhost/peminjamanberkas/peminjaman/getdataapi",
//     async : false,
//     dataType : 'json',
//     data: {
//     tipe:'1'
//     },
//     success : function(dataku){
//         console.log("data 1 "+dataku);
//     Morris.Bar({
//         element: 'morris-bar-chart',
//         data: dataku,
//         xkey: 'namapoli',
//         ykeys: ['jumlahtelat'],
//         labels: ['Jumlah Terlambat'],
//         barColors:['#009efb'],
//         hideHover: 'auto',
//         gridLineColor: '#eef0f2',
//         resize: true
//     });
// }

// });
// Extra chart
 Morris.Area({
        element: 'extra-area-chart',
        data: [{
                    period: '2010',
                    iphone: 0,
                    ipad: 0,
                    itouch: 0
                }, {
                    period: '2011',
                    iphone: 50,
                    ipad: 15,
                    itouch: 5
                }, {
                    period: '2012',
                    iphone: 20,
                    ipad: 50,
                    itouch: 65
                }, {
                    period: '2013',
                    iphone: 60,
                    ipad: 12,
                    itouch: 7
                }, {
                    period: '2014',
                    iphone: 30,
                    ipad: 20,
                    itouch: 120
                }, {
                    period: '2015',
                    iphone: 25,
                    ipad: 80,
                    itouch: 40
                }, {
                    period: '2016',
                    iphone: 10,
                    ipad: 10,
                    itouch: 10
                }


                ],
                lineColors: ['#55ce63', '#2f3d4a', '#009efb'],
                xkey: 'period',
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['Site A', 'Site B', 'Site C'],
                pointSize: 0,
                lineWidth: 0,
                resize:true,
                fillOpacity: 0.8,
                behaveLikeLine: true,
                gridLineColor: '#e0e0e0',
                hideHover: 'auto'
        
    });
 });    