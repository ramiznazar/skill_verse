
<?php $__env->startSection('content'); ?>
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-12">
                    <div class="card top_report">
                        <div class="row clearfix">

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-user-plus fa-2x text-col-blue"></i> 
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Total Leads</h6>
                                            <span class="font700 text-primary"><?php echo e($totalLeads); ?></span>
                                        </div>
                                    </div>

                                    <div class="progress progress-xs progress-transparent custom-color-red mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="<?php echo e(intval($leadProgress)); ?>"
                                            style="width: 0%">
                                            <?php echo e(intval($leadProgress)); ?>%
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-user-plus fa-2x text-col-yellow"></i> 
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Leads This Month</h6>
                                            <span class="font700 text-warning"><?php echo e($monthlyLeads); ?></span>
                                        </div>
                                    </div>

                                    <div class="progress progress-xs progress-transparent custom-color-yellow mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="<?php echo e(intval($leadProgress)); ?>"
                                            style="width: 0%">
                                            <?php echo e(intval($leadProgress)); ?>%
                                        </div>
                                    </div>

                                    <small class="text-muted" style="font-size: 10px">
                                        <?php if($leadChangeDirection === 'up'): ?>
                                            <span class="text-dark">
                                                ↑ (+<?php echo e($leadDifference); ?> leads) compared to last month
                                            </span>
                                        <?php else: ?>
                                            <span class="text-danger">
                                                ↓ (−<?php echo e(abs($leadDifference)); ?> leads) compared to last month
                                            </span>
                                        <?php endif; ?>
                                    </small>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-users fa-2x text-col-blue"></i>
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Total Students</h6>
                                            <span class="font700 text-primary"><?php echo e($totalStudents); ?></span>
                                        </div>
                                    </div>

                                    <div class="progress progress-xs progress-transparent custom-color-blue mb-0 mt-3">
                                        <div class="progress-bar" data-transitiongoal="<?php echo e(intval($studentProgress)); ?>"
                                            style="width: 0%">
                                            <?php echo e(intval($studentProgress)); ?>%
                                        </div>
                                    </div>
                                    

                                    
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="fa fa-user-graduate fa-2x text-col-green"></i> 
                                        </div>
                                        <div class="number float-right text-right">
                                            <h6>Students This Month</h6>
                                            <span class="font700 text-success"><?php echo e($studentsThisMonth); ?></span>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs progress-transparent custom-color-green mb-0 mt-3">
                                        <div class="progress-bar"
                                            data-transitiongoal="<?php echo e(intval($monthlyStudentProgress)); ?>" style="width: 0%">
                                            <?php echo e(intval($monthlyStudentProgress)); ?>%
                                        </div>
                                    </div>
                                    <small class="text-muted" style="font-size: 10px">
                                        <?php if($studentChangeDirection === 'up'): ?>
                                            <span class="text-dark">↑ (+<?php echo e($studentDifference); ?> students) compared to last
                                                month</span>
                                        <?php else: ?>
                                            <span class="text-danger">↓ <?php echo e($studentChangePercent); ?>%
                                                (−<?php echo e(abs($studentDifference)); ?> students) compared to last month</span>
                                        <?php endif; ?>
                                    </small>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?php if(auth()->check() && auth()->user()->role !== 'administrator'): ?>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header bline d-flex justify-content-between align-items-center">
                                <h2>Financial Overview</h2>
                                <ul class="header-dropdown dropdown dropdown-animated scale-left"
                                    style="display: flex; gap: 5px;">
                                    <li><a id="btnWeekly" class="btn btn-outline-primary btn-sm"
                                            href="javascript:void(0);">Weekly</a></li>
                                    <li><a id="btnMonthly" class="btn btn-primary btn-sm"
                                            href="javascript:void(0);">Monthly</a>
                                    </li>
                                    <li><a id="btnYearly" class="btn btn-outline-primary btn-sm"
                                            href="javascript:void(0);">Yearly</a></li>
                                </ul>
                            </div>
                            <div class="body">
                                <div id="User_Statistics" class="mt-2" style="height: 290px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row clearfix">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="header d-flex justify-content-between align-items-center">
                            <h2>Student Sources</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left"
                                style="display:flex; gap:5px;">
                                <li>
                                    <a id="btnLeadMonthly" class="btn btn-outline-primary btn-sm"
                                        href="javascript:void(0);">This Month</a>
                                </li>
                                <li>
                                    <a id="btnLeadOverall" class="btn btn-primary btn-sm"
                                        href="javascript:void(0);">Overall</a>
                                </li>

                            </ul>
                        </div>
                        <div class="body">
                            <div id="leadSourceChart" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Top 5 Courses by Admissions</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li>
                                    <a href="javascript:void(0);" id="refreshTopCourses"><i class="icon-refresh"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="chart-top-courses" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional-javascript'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.4/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        $(document).ready(function() {
            $('.progress .progress-bar').progressbar();
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        let chart;

        function loadChart(url, activeBtn) {
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (!chart) {
                        chart = new ApexCharts(document.querySelector("#User_Statistics"), {
                            chart: {
                                height: 290,
                                type: 'line',
                                toolbar: {
                                    show: false
                                }
                            },
                            series: data.series,
                            xaxis: {
                                categories: data.categories,
                                labels: {
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            },
                            colors: ['#FFA500', '#28a745', '#6c757d'],
                            dataLabels: {
                                enabled: true,
                                offsetY: -6,
                                style: {
                                    fontSize: '12px'
                                },
                                background: {
                                    enabled: false
                                }
                            },
                            stroke: {
                                curve: 'smooth',
                                width: 2
                            },
                            markers: {
                                size: 4,
                                hover: {
                                    size: 6
                                }
                            },
                            legend: {
                                position: 'bottom',
                                fontSize: '14px'
                            },
                            grid: {
                                padding: {
                                    left: 25,
                                    right: 12
                                },
                                strokeDashArray: 4
                            }
                        });
                        chart.render();
                    } else {
                        chart.updateOptions({
                            series: data.series,
                            xaxis: {
                                categories: data.categories
                            }
                        });
                    }

                    // Highlight the active button
                    document.querySelectorAll('.header-dropdown a').forEach(btn => {
                        btn.classList.remove('btn-primary');
                        btn.classList.add('btn-outline-primary');
                    });
                    document.getElementById(activeBtn).classList.remove('btn-outline-primary');
                    document.getElementById(activeBtn).classList.add('btn-primary');
                });
        }

        document.getElementById('btnWeekly').addEventListener('click', () => loadChart("<?php echo e(route('chart.weekly')); ?>",
            'btnWeekly'));
        document.getElementById('btnMonthly').addEventListener('click', () => loadChart("<?php echo e(route('chart.monthly')); ?>",
            'btnMonthly'));
        document.getElementById('btnYearly').addEventListener('click', () => loadChart("<?php echo e(route('chart.yearly')); ?>",
            'btnYearly'));

        // Default load Monthly
        loadChart("<?php echo e(route('chart.monthly')); ?>", 'btnMonthly');
    </script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Chartist.Bar('#chart-top-products', {
                labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Q5'],
                series: [
                    [3000, 3500, 4000, 3800, 3900],
                    [2000, 3000, 1500, 2500, 2700],
                    [1500, 4000, 2000, 1800, 2600]
                ]
            }, {
                stackBars: true,
                axisY: {
                    labelInterpolationFnc: function(value) {
                        return (value / 1000) + 'k';
                    }
                },
                plugins: [
                    // Optional Chartist plugin for tooltip, if used in template
                ]
            });
        });
    </script>

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        let leadChart;

        function renderLeadSourceChart(labels, series) {
            let options = {
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: labels,
                series: series,
                colors: ['#FF9800', '#4CAF50', '#2196F3'],
                legend: {
                    position: 'bottom'
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        return opts.w.globals.series[opts.seriesIndex] + ' (' + val.toFixed(1) + '%)';
                    }
                }
            };

            if (!leadChart) {
                leadChart = new ApexCharts(document.querySelector("#leadSourceChart"), options);
                leadChart.render();
            } else {
                leadChart.updateOptions({
                    series: series,
                    labels: labels
                });
            }
        }

        // Attach event listeners
        document.getElementById('btnLeadMonthly').addEventListener('click', function() {
            renderLeadSourceChart(<?php echo json_encode($leadSourceLabels, 15, 512) ?>, <?php echo json_encode($leadSourceSeriesMonthly, 15, 512) ?>);
            setActiveButton('btnLeadMonthly', 'btnLeadOverall');
        });

        document.getElementById('btnLeadOverall').addEventListener('click', function() {
            renderLeadSourceChart(<?php echo json_encode($leadSourceLabels, 15, 512) ?>, <?php echo json_encode($leadSourceSeriesOverall, 15, 512) ?>);
            setActiveButton('btnLeadOverall', 'btnLeadMonthly');
        });

        function setActiveButton(activeId, inactiveId) {
            document.getElementById(activeId).classList.remove('btn-outline-primary');
            document.getElementById(activeId).classList.add('btn-primary');
            document.getElementById(inactiveId).classList.remove('btn-primary');
            document.getElementById(inactiveId).classList.add('btn-outline-primary');
        }

        document.addEventListener('DOMContentLoaded', function() {
            renderLeadSourceChart(<?php echo json_encode($leadSourceLabels, 15, 512) ?>, <?php echo json_encode($leadSourceSeriesOverall, 15, 512) ?>);
            setActiveButton('btnLeadOverall', 'btnLeadMonthly');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        function renderTopCoursesChart(categories, series) {
            let options = {
                chart: {
                    type: 'bar',
                    height: 300
                },
                series: [{
                    name: 'Admissions',
                    data: series
                }],
                xaxis: {
                    categories: categories,
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0'],
                plotOptions: {
                    bar: {
                        distributed: true,
                        horizontal: false,
                        columnWidth: '50%'
                    }
                },
                dataLabels: {
                    enabled: true
                },
                legend: {
                    show: false
                }
            };

            let chart = new ApexCharts(document.querySelector("#chart-top-courses"), options);
            chart.render();
        }

        // Load chart with PHP data
        renderTopCoursesChart(<?php echo json_encode($topCourseCategories, 15, 512) ?>, <?php echo json_encode($topCourseSeries, 15, 512) ?>);

        // Refresh on click
        document.getElementById('refreshTopCourses').addEventListener('click', function() {
            document.querySelector("#chart-top-courses").innerHTML = '';
            renderTopCoursesChart(<?php echo json_encode($topCourseCategories, 15, 512) ?>, <?php echo json_encode($topCourseSeries, 15, 512) ?>);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\codezy\zain-changes\codezy\resources\views/admin/index.blade.php ENDPATH**/ ?>