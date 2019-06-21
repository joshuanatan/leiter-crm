<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
                <button type="button" data-target = "#insertweek" data-toggle = "modal" class = "btn btn-primary btn-outline">Insert Week
                </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>WEEK</th> <!-- nanti ini keisi waktu nambahin OC-->
                <th>Start Date</th>
                <th>End Date</th>
                <th>Report Submission</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td><td>
                <td></td>
                <td>
                    <button type = "button" class = "btn btn-outline btn-primary" data-target = "#weeklyReport1" data-toggle = "modal">Reports</button>
                    <div class = "modal fade" id = "weeklyReport1">
                        <div class = "modal-xl modal-dialog">
                            <form action = "<?php echo base_url();?>report/kpi/weekly/1">
                                <div class = "modal-content">
                                    <div class = "modal-header">
                                        <h4 class = "modal-title">CHECK WEEKLY REPORT</h4>
                                    </div>
                                    <div class = "modal-body">
                                        <div class = "row">
                                            <div class = "col-lg-9">
                                                <div class = "form-group">
                                                    <select class = "form-control">
                                                        <option>Select Employee</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class = "col-lg-2">
                                                <div class = "form-group">
                                                    <button class = "btn btn-primary btn-outline" type = "submit">SEE REPORT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button type = "button" class = "btn btn-outline btn-primary" data-target = "#weeklyTarget1" data-toggle = "modal">Target</button>
                    <div class = "modal fade" id = "weeklyTarget1">
                        <div class = "modal-xl modal-dialog">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">CHECK WEEKLY REPORT</h4>
                                </div>
                                <div class = "modal-body">
                                    <div class = "form-group">
                                        <select class = "form-control">
                                            <option>Select Employee</option>
                                        </select>
                                    </div>
                                    <table class = "table table-bordered table-stripped">
                                        <thead>
                                            <th>KPI Name</th>
                                            <th>Target</th>
                                        </thead>
                                        <tbody id = "employeeKPI">
                                            <tr>
                                                <td>LinkedIn</td>
                                                <td><input type = "text" class = "form-control"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class = "form-group">
                                        <button type = "submit" class = "btn btn-primary btn-outline">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class = "modal fade" id = "insertweek">
    <div class = "modal-dialog modal-xl">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">REGISTER NEW WEEK</h4>
            </div>
            <div class = "modal-body">
                <div class = "form-group">
                    <h5 style = "opacity:0.5">New Week</h5>
                    <input type = "text" class = "form-control" readonly>
                </div>
                <div class = "form-group">
                    <h5 style = "opacity:0.5">Start Date</h5>
                    <input type = "date" class = "form-control">
                </div>
                <div class = "form-group">
                    <h5 style = "opacity:0.5">End Date</h5>
                    <input type = "date" class = "form-control">
                </div>
                <div class = "form-group">
                    <button class = "btn btn-primary btn-ouline col-lg-3">NEW WEEK</button>
                </div>
            </div>
        </div>
    </div>
</div>