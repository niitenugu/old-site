<div class="col-lg-12">
  <div class="padded-lg">
    <div class="element-wrapper">
      <div class="element-actions">
        <a href="{{ route('admin.scholarship_attendees.index', $currentScholarship->uid) }}" class="btn btn-sm btn-primary">View details</a>

      </div>
      <h6 class="element-header">
        Current Scholarship Statistics
      </h6>
      <div class="element-box">
        <div class="padded m-b">
          <div class="centered-header">
            <h6>
              Current Statistics
            </h6>
          </div>
          <div class="row">
            <div class="col-6 b-r b-b">
              <div class="el-tablo centered padded-v-big highlight bigger">
                <div class="label">
                  Total Registrations
                </div>
                <div class="value">
                  {{ $totalAttendees }}
                </div>
              </div>
            </div>
            <div class="col-6 b-b">
              <div class="el-tablo centered padded-v-big highlight bigger">
                <div class="label">
                  Today's Registration
                </div>
                <div class="value">
                  {{ $totalRegistrationToday }}
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="padded m-b">
          <div class="centered-header">
            <h6>
              Most Recent Registrations
            </h6>
          </div>

          <div class="table-responsive">
            <table class="table table-lightborder">
              {{-- <thead>
                <tr>
                  <th>
                    Customer Name
                  </th>
                  <th>
                    Tickets
                  </th>
                  <th>
                    Location
                  </th>
                  <th class="text-center">
                    Status
                  </th>
                  <th class="text-right">
                    Last Reply
                  </th>
                </tr>
              </thead> --}}
              <tbody>
                @forelse ($recentAttendees as $recentAttendee)
                  <tr>
                    <td width="35%"> 
                      {{ $recentAttendee->fullName }} <br>
                      <code>{{ $recentAttendee->invitation_code }}</code>
                    </td>
                    <td width="30%">
                      {{ $recentAttendee->email }} <br>
                      <span>{{ $recentAttendee->phone }}</span>
                    </td>
                    <td width="35%" class="text-right">
                      {{ $recentAttendee->created_at->diffForHumans() }} <br>
                      <span class="smaller lighter">{{ $recentAttendee->created_at->format('d F, Y @ h:ia') }}</span>
                    </td>
                  </tr>

                @empty

                  <tr>
                    <td colspan="3" class="text-center">No recent registrations</td>
                  </tr>

                @endforelse
                
              </tbody>
            </table>
          </div>
        </div>



        {{-- <div class="padded m-b">
          <div class="centered-header">
            <h6>
              Completions
            </h6>
          </div>
          <div class="os-progress-bar primary">
            <div class="bar-labels">
              <div class="bar-label-left">
                <span>Progress</span><span class="positive">+12</span>
              </div>
              <div class="bar-label-right">
                <span class="info">72/100</span>
              </div>
            </div>
            <div class="bar-level-1" style="width: 100%">
              <div class="bar-level-2" style="width: 72%">
                <div class="bar-level-3" style="width: 25%"></div>
              </div>
            </div>
          </div>
          <div class="os-progress-bar primary">
            <div class="bar-labels">
              <div class="bar-label-left">
                <span>Progress</span><span class="negative">-5</span>
              </div>
              <div class="bar-label-right">
                <span class="info">54/100</span>
              </div>
            </div>
            <div class="bar-level-1" style="width: 100%">
              <div class="bar-level-2" style="width: 54%">
                <div class="bar-level-3" style="width: 25%"></div>
              </div>
            </div>
          </div>
          <div class="os-progress-bar primary">
            <div class="bar-labels">
              <div class="bar-label-left">
                <span>Progress</span><span class="positive">+5</span>
              </div>
              <div class="bar-label-right">
                <span class="info">86/100</span>
              </div>
            </div>
            <div class="bar-level-1" style="width: 100%">
              <div class="bar-level-2" style="width: 86%">
                <div class="bar-level-3" style="width: 25%"></div>
              </div>
            </div>
          </div>
        </div> --}}
        

        {{-- <div class="padded">
          <div class="centered-header">
            <h6>
              Tasks Closed
            </h6>
          </div>
          <div class="el-chart-w"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
            <canvas height="294" id="liteLineChart" width="679" class="chartjs-render-monitor" style="display: block; width: 679px; height: 294px;"></canvas>
          </div>
        </div> --}}


      </div>
    </div>
    <!--END - Projects Statistics-->
  </div>
</div>