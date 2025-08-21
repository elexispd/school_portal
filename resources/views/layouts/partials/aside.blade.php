<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Users</li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#staff-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-lines-fill"></i><span>Staff</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="staff-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('staff.create') }}">
              <i class="bi bi-circle"></i><span>Add Staff</span>
            </a>
          </li>
          <li>
            <a href="{{ route('staff.index') }}">
              <i class="bi bi-circle"></i><span>View Staff</span>
            </a>
          </li>
        </ul>
      </li><!-- End Staff Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#student-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Students</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="student-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('students.create') }}">
              <i class="bi bi-circle"></i><span>Add Student</span>
            </a>
          </li>
          <li>
            <a href="{{ route('students.search') }}">
              <i class="bi bi-circle"></i><span>View Students</span>
            </a>
          </li>
        </ul>
      </li><!-- End Student Nav -->



      <li class="nav-heading">Configuration</li>
      <!-- Session -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#session-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear"></i><span>Session</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="session-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('sessions.create') }}">
              <i class="bi bi-circle"></i><span>Create Session</span>
            </a>
          </li>
          <li>
            <a href="{{ route('sessions.index') }}">
              <i class="bi bi-circle"></i><span>View Session</span>
            </a>
          </li>
        </ul>
      </li><!-- End Session Nav -->

      <!-- Class -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#class-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-bookmark-fill"></i><span>Class</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="class-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('classes.create') }}">
              <i class="bi bi-circle"></i><span>Create Class</span>
            </a>
          </li>
          <li>
            <a href="{{ route('classes.index') }}">
              <i class="bi bi-circle"></i><span>View Classes</span>
            </a>
          </li>
        </ul>
      </li><!-- End Class Nav -->

      <!-- Class Arm -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#classarm-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-diagram-3-fill"></i><span>Class Arm</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="classarm-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('classarms.create') }}">
              <i class="bi bi-circle"></i><span>Create Class Arm</span>
            </a>
          </li>
          <li>
            <a href="{{ route('classarms.index') }}">
              <i class="bi bi-circle"></i><span>View Class Arm</span>
            </a>
          </li>
        </ul>
      </li><!-- End Class Arm Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#subject-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-book-fill"></i><span>Subjects</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="subject-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('subjects.create') }}">
              <i class="bi bi-circle"></i><span>Add Subject</span>
            </a>
          </li>
          <li>
            <a href="{{ route('subjects.index') }}">
              <i class="bi bi-circle"></i><span>View Subject</span>
            </a>
          </li>

        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-heading">Results</li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#results-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-bar-graph-fill"></i><span>Results</span><i
            class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="results-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('results.upload') }}">
              <i class="bi bi-circle"></i><span>Upload Result</span>
            </a>
          </li>
          <li>
            <a href="{{ route('results.show') }}">
              <i class="bi bi-circle"></i><span>View Result</span>
            </a>
          </li>
          <li>
            <a href="{{ route('results.mastersheet.show') }}">
              <i class="bi bi-circle"></i><span>Result Mastersheet</span>
            </a>
          </li>
        </ul>
      </li><!-- End Results Nav -->





      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->




    </ul>

  </aside>
