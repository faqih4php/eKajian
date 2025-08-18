@extends('layouts.base')
@section('title', 'Jadwal Kajian')
@push('css')
    <link rel="stylesheet" href="/assets/vendor/css/pages/app-calendar.css">
    <link rel="stylesheet" href="/assets/vendor/libs/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css">
    <link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css">
    <link rel="stylesheet" href="/assets/vendor/libs/quill/editor.css">
    <link rel="stylesheet" href="/assets/vendor/libs/%40form-validation/form-validation.css">
@endpush
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card app-calendar-wrapper">
                <div class="row g-0">
                    <!-- Calendar Sidebar -->
                    <div class="col app-calendar-sidebar border-end" id="app-calendar-sidebar">
                        @auth
                            <div class="border-bottom p-6 my-sm-0 mb-4">
                                <button class="btn btn-primary btn-toggle-sidebar w-100" data-bs-toggle="offcanvas"
                                    data-bs-target="#addEventSidebar" aria-controls="addEventSidebar">
                                    <i class="icon-base bx bx-plus icon-16px me-2"></i>
                                    <span class="align-middle">Tambah Jadwal</span>
                                </button>
                            </div>
                        @endauth
                        <div class="px-3 pt-2">
                            <!-- inline calendar (flatpicker) -->
                            <div class="inline-calendar"></div>
                        </div>
                        <hr class="mb-6 mx-n4 mt-3">
                        <div class="px-6 pb-2">
                            <!-- Filter -->
                            <div>
                                <h5>Event Filters</h5>
                            </div>

                            <div class="form-check form-check-secondary mb-5 ms-2">
                                <input class="form-check-input select-all" type="checkbox" id="selectAll" data-value="all"
                                    checked="">
                                <label class="form-check-label" for="selectAll">View All</label>
                            </div>

                            <div class="app-calendar-events-filter text-heading">
                                <div class="form-check form-check-danger mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-personal"
                                        data-value="personal" checked="">
                                    <label class="form-check-label" for="select-personal">Personal</label>
                                </div>
                                <div class="form-check mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-business"
                                        data-value="business" checked="">
                                    <label class="form-check-label" for="select-business">Business</label>
                                </div>
                                <div class="form-check form-check-warning mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-family"
                                        data-value="family" checked="">
                                    <label class="form-check-label" for="select-family">Family</label>
                                </div>
                                <div class="form-check form-check-success mb-5 ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-holiday"
                                        data-value="holiday" checked="">
                                    <label class="form-check-label" for="select-holiday">Holiday</label>
                                </div>
                                <div class="form-check form-check-info ms-2">
                                    <input class="form-check-input input-filter" type="checkbox" id="select-etc"
                                        data-value="etc" checked="">
                                    <label class="form-check-label" for="select-etc">ETC</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Calendar Sidebar -->
                    <!-- Calendar & Modal -->
                    <div class="col app-calendar-content">
                        <div class="card shadow-none border-0">
                            <div class="card-body pb-0">
                                <!-- FullCalendar -->
                                <div id="calendar"></div>
                            </div>
                        </div>
                        <div class="app-overlay"></div>
                        <!-- FullCalendar Offcanvas -->
                        <div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addEventSidebar"
                            aria-labelledby="addEventSidebarLabel">
                            <div class="offcanvas-header border-bottom">
                                <h5 class="offcanvas-title" id="addEventSidebarLabel">Tambah Jadwal</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form action="{{ route('jadwal-kajian.store') }}" method="POST" class="event-form pt-0"
                                    id="eventForm" onsubmit="return false">
                                    @csrf
                                    <div class="mb-6 form-control-validation">
                                        <label class="form-label" for="kajianTheme">Tema Kajian</label>
                                        <input type="text" class="form-control" id="kajianTheme" name="kajianTheme"
                                            placeholder="Masukkan Tema Kajian">
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label" for="lokasiKajian">Lokasi</label>
                                        <input type="text" class="form-control" id="lokasiKajian" name="lokasiKajian"
                                            placeholder="Enter Location">
                                    </div>
                                    <div class="mb-6 form-control-validation">
                                        <label class="form-label" for="dateKajian">Tanggal Kajian</label>
                                        <input type="text" class="form-control" id="dateKajian" name="dateKajian"
                                            placeholder="Masukkan Tanggal Kajian">
                                    </div>
                                    <div class="mb-6 d-none">
                                        <label class="form-label" for="eventLabel">Label</label>
                                        <select class="select2 select-event-label form-select" id="eventLabel"
                                            name="eventLabel">
                                            <option data-label="primary" value="Business" selected="">
                                                Business</option>
                                            <option data-label="danger" value="Personal">Personal</option>
                                            <option data-label="warning" value="Family">Family</option>
                                            <option data-label="success" value="Holiday">Holiday</option>
                                            <option data-label="info" value="ETC">ETC</option>
                                        </select>
                                    </div>
                                    <div class="mb-6 form-control-validation d-none">
                                        <label class="form-label" for="eventEndDate">End Date</label>
                                        <input type="text" class="form-control" id="eventEndDate" name="eventEndDate"
                                            placeholder="End Date">
                                    </div>
                                    <div class="mb-6 d-none">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input allDay-switch"
                                                id="allDaySwitch">
                                            <label class="form-check-label" for="allDaySwitch">All
                                                Day</label>
                                        </div>
                                    </div>
                                    <div class="mb-6 d-none">
                                        <label class="form-label" for="eventURL">Event URL</label>
                                        <input type="url" class="form-control" id="eventURL" name="eventURL"
                                            placeholder="https://www.google.com">
                                    </div>
                                    <div class="mb-4 select2-primary d-none">
                                        <label class="form-label" for="eventGuests">Add Guests</label>
                                        <select class="select2 select-event-guests form-select" id="eventGuests"
                                            name="eventGuests" multiple="">
                                            <option data-avatar="1.png" value="Jane Foster">Jane Foster
                                            </option>
                                            <option data-avatar="3.png" value="Donna Frank">Donna Frank
                                            </option>
                                            <option data-avatar="5.png" value="Gabrielle Robertson">
                                                Gabrielle Robertson</option>
                                            <option data-avatar="7.png" value="Lori Spears">Lori Spears
                                            </option>
                                            <option data-avatar="9.png" value="Sandy Vega">Sandy Vega
                                            </option>
                                            <option data-avatar="11.png" value="Cheryl May">Cheryl May
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-6 d-none">
                                        <label class="form-label" for="eventDescription">Description</label>
                                        <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
                                    </div>
                                    <div class="d-flex justify-content-sm-between justify-content-start mt-6 gap-2">
                                        <div class="d-flex">
                                            <button type="submit" id="addEventBtn"
                                                class="btn btn-primary btn-add-event me-4">Add</button>
                                            <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1"
                                                data-bs-dismiss="offcanvas">Cancel</button>
                                        </div>
                                        <button class="btn btn-label-danger btn-delete-event d-none">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Calendar & Modal -->
                </div>
            </div>

        </div>
        <div class="container-xxl flex-grow-1 container-p-y">


            @auth
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header">List Jadwal Kajian</h5>
                        <a href="{{ route('jadwal-kajian.create') }}" type="button" class="btn btn-primary h-50 me-7">Buat
                            Jadwal</a>
                    </div>
                    <div class="table-responsive text-nowrap">
                        @include('components.alert')
                        <div class="container mb-3">
                            <table class="table p-3" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Tema Kajian</th>
                                        <th>Lokasi</th>
                                        <th>Jenis Kajian</th>
                                        <th>Waktu Kajian</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($jadwalKajians as $jadwalKajian)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $jadwalKajian->name }}</td>
                                            <td>
                                                @if ($jadwalKajian->tema_kajian == null)
                                                    {{ Str::limit('Tidak ada tema kajian', 10) }}
                                                @else
                                                    {{ Str::limit($jadwalKajian->tema_kajian, 20) }}
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($jadwalKajian->lokasi, 10) }}</td>
                                            <td>{{ $jadwalKajian->jenis_kajian->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jadwalKajian->waktu_kajian)->format('l, d F Y H:i') }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="icon-base bx bx-dots-vertical-rounded"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('jadwal-kajian.edit', $jadwalKajian->id) }}"><i
                                                                class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                                                        <form
                                                            action="{{ route('jadwal-kajian.destroy', $jadwalKajian->id) }}"
                                                            method="POST" onsubmit="return confirm('Yakin mau hapus?')"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item">
                                                                <i class="icon-base bx bx-trash me-1"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
        <!-- / Content -->




        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection

@push('js')
    <script src="/assets/vendor/libs/fullcalendar/fullcalendar.js"></script>
    <script src="/assets/vendor/libs/%40form-validation/popular.js"></script>
    <script src="/assets/vendor/libs/%40form-validation/bootstrap5.js"></script>
    <script src="/assets/vendor/libs/%40form-validation/auto-focus.js"></script>
    <script src="/assets/vendor/libs/select2/select2.js"></script>
    <script src="/assets/vendor/libs/moment/moment.js"></script>
    <script src="/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script>
        let date = new Date,
            nextDay = new Date((new Date).getTime() + 864e5),
            nextMonth = 11 === date.getMonth() ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date
                .getMonth() + 1, 1),
            prevMonth = 11 === date.getMonth() ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date
                .getMonth() - 1, 1);
        window.events = [];

        document.addEventListener("DOMContentLoaded", function() {
            let k = isRtl ? "rtl" : "ltr";
            {
                var w = document.getElementById("calendar");
                let t = document.querySelector(".app-calendar-sidebar");
                var x = document.getElementById("addEventSidebar");
                let n = document.querySelector(".app-overlay"),
                    a = document.querySelector(".offcanvas-title");
                var T = document.querySelector(".btn-toggle-sidebar");
                let l = document.getElementById("addEventBtn"),
                    i = document.querySelector(".btn-delete-event"),
                    r = document.querySelector(".btn-cancel"),
                    d = document.getElementById("kajianTheme"),
                    o = document.getElementById("dateKajian"),
                    s = document.getElementById("eventEndDate"),
                    c = document.getElementById("eventURL"),
                    u = document.getElementById("lokasiKajian"),
                    v = document.getElementById("eventDescription"),
                    m = document.querySelector(".allDay-switch"),
                    p = document.querySelector(".select-all");
                var D, P, M = Array.from(document.querySelectorAll(".input-filter")),
                    A = document.querySelector(".inline-calendar");
                let g = {
                        Business: "primary",
                        Holiday: "success",
                        Personal: "danger",
                        Family: "warning",
                        ETC: "info"
                    },
                    f = $("#eventLabel"),
                    h = $("#eventGuests"),
                    b = events,
                    y = !1,
                    E = null,
                    e = null,
                    L = new bootstrap.Offcanvas(x);

                function q(e) {
                    return e.id ? "<span class='badge badge-dot bg-" + $(e.element).data("label") +
                        " me-2'> </span>" + e.text : e.text
                }

                function B(e) {
                    return e.id ? `
    <div class='d-flex flex-wrap align-items-center'>
      <div class='avatar avatar-xs me-2'>
        <img src='${assetsPath}img/avatars/${$(e.element).data("avatar")}'
          alt='avatar' class='rounded-circle' />
      </div>
      ${e.text}
    </div>` : e.text
                }

                function I() {
                    var e = document.querySelector(".fc-sidebarToggle-button");
                    for (e.classList.remove("fc-button-primary"), e.classList.add("d-lg-none", "d-inline-block",
                            "ps-0"); e.firstChild;) e.firstChild.remove();
                    e.setAttribute("data-bs-toggle", "sidebar"), e.setAttribute("data-overlay", ""), e.setAttribute(
                        "data-target", "#app-calendar-sidebar"), e.insertAdjacentHTML("beforeend",
                        '<i class="icon-base bx bx-menu icon-lg text-heading"></i>')
                }
                f.length && f.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Select value",
                    dropdownParent: f.parent(),
                    templateResult: q,
                    templateSelection: q,
                    minimumResultsForSearch: -1,
                    escapeMarkup: function(e) {
                        return e
                    }
                }), h.length && h.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Select value",
                    dropdownParent: h.parent(),
                    closeOnSelect: !1,
                    templateResult: B,
                    templateSelection: B,
                    escapeMarkup: function(e) {
                        return e
                    }
                }), o && (D = o.flatpickr({
                    monthSelectorType: "static",
                    static: !0,
                    enableTime: !0,
                    altFormat: "Y-m-dTH:i:S",
                    onReady: function(e, t, n) {
                        n.isMobile && n.mobileInput.setAttribute("step", null)
                    }
                })), s && (P = s.flatpickr({
                    monthSelectorType: "static",
                    static: !0,
                    enableTime: !0,
                    altFormat: "Y-m-dTH:i:S",
                    onReady: function(e, t, n) {
                        n.isMobile && n.mobileInput.setAttribute("step", null)
                    }
                })), A && (e = A.flatpickr({
                    monthSelectorType: "static",
                    static: !0,
                    inline: !0
                }));
                let S = new Calendar(w, {
                    initialView: "dayGridMonth",
                    events: function(e, t) {
                        let n = (() => {
                            let t = [],
                                e = [].slice.call(document.querySelectorAll(
                                    ".input-filter:checked"));
                            return e.forEach(e => {
                                t.push(e.getAttribute("data-value"))
                            }), t
                        })();
                        t(b.filter(function(e) {
                            return n.includes(e.extendedProps.calendar.toLowerCase())
                        }))
                    },
                    plugins: [dayGridPlugin, interactionPlugin, listPlugin, timegridPlugin],
                    editable: !0,
                    dragScroll: !0,
                    dayMaxEvents: 2,
                    eventResizableFromStart: !0,
                    customButtons: {
                        sidebarToggle: {
                            text: "Sidebar"
                        }
                    },
                    headerToolbar: {
                        start: "sidebarToggle, prev,next, title",
                        end: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                    },
                    direction: k,
                    initialDate: new Date,
                    navLinks: !0,
                    eventClassNames: function({
                        event: e
                    }) {
                        return ["bg-label-" + g[e._def.extendedProps.calendar]]
                    },
                    dateClick: function(e) {
                        e = moment(e.date).format("YYYY-MM-DD");
                        F(), L.show(), a && (a.innerHTML = "Add Schedule"), l.innerHTML = "Add", l
                            .classList.remove("btn-update-event"), l.classList.add("btn-add-event"), i
                            .classList.add("d-none"), o.value = e, s.value = e
                    },
                    eventClick: function(e) {
                        e = e, (E = e.event).url && (e.jsEvent.preventDefault(), window.open(E.url,
                                "_blank")), L.show(), a && (a.innerHTML = "Update Event"), l.innerHTML =
                            "Update", l.classList.add("btn-update-event"), l.classList.remove(
                                "btn-add-event"), i.classList.remove("d-none"), d.value = E.title, D
                            .setDate(E.start, !0, "Y-m-d"), !0 === E.allDay ? m.checked = !0 : m
                            .checked = !1, null !== E.end ? P.setDate(E.end, !0, "Y-m-d") : P.setDate(E
                                .start, !0, "Y-m-d"), f.val(E.extendedProps.calendar).trigger("change"),
                            void 0 !== E.extendedProps.location && (u.value = E.extendedProps.location),
                            void 0 !== E.extendedProps.guests && h.val(E.extendedProps.guests).trigger(
                                "change"), void 0 !== E.extendedProps.description && (v.value = E
                                .extendedProps.description)
                    },
                    datesSet: function() {
                        I()
                    },
                    viewDidMount: function() {
                        I()
                    }
                });

                function F() {
                    s.value = "", c.value = "", o.value = "", d.value = "", u.value = "", m.checked = !1, h.val("")
                        .trigger("change"), v.value = ""
                }
                S.render(), I(), A = document.getElementById("eventForm"), FormValidation.formValidation(A, {
                    fields: {
                        kajianTheme: {
                            validators: {
                                notEmpty: {
                                    message: "Please enter event title "
                                }
                            }
                        },
                        eventStartDate: {
                            validators: {
                                notEmpty: {
                                    message: "Please enter start date "
                                }
                            }
                        },
                        eventEndDate: {
                            validators: {
                                notEmpty: {
                                    message: "Please enter end date "
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap5: new FormValidation.plugins.Bootstrap5({
                            eleValidClass: "",
                            rowSelector: function(e, t) {
                                return ".form-control-validation"
                            }
                        }),
                        submitButton: new FormValidation.plugins.SubmitButton,
                        autoFocus: new FormValidation.plugins.AutoFocus
                    }
                }).on("core.form.valid", function() {
                    y = !0
                }).on("core.form.invalid", function() {
                    y = !1
                }), T && T.addEventListener("click", e => {
                    r.classList.remove("d-none")
                }), l.addEventListener("click", e => {
                    var t, n;
                    l.classList.contains("btn-add-event") ? y && (n = {
                            id: S.getEvents().length + 1,
                            title: d.value,
                            start: o.value,
                            end: s.value,
                            startStr: o.value,
                            endStr: s.value,
                            display: "block",
                            extendedProps: {
                                location: u.value,
                                guests: h.val(),
                                calendar: f.val(),
                                description: v.value
                            }
                        }, c.value && (n.url = c.value), m.checked && (n.allDay = !0), n = n, b.push(n),
                        S.refetchEvents(), L.hide()) : y && (n = {
                            id: E.id,
                            title: d.value,
                            start: o.value,
                            end: s.value,
                            url: c.value,
                            extendedProps: {
                                location: u.value,
                                guests: h.val(),
                                calendar: f.val(),
                                description: v.value
                            },
                            display: "block",
                            allDay: !!m.checked
                        }, (t = n).id = parseInt(t.id), b[b.findIndex(e => e.id === t.id)] = t, S
                        .refetchEvents(), L.hide())
                }), i.addEventListener("click", e => {
                    var t;
                    t = parseInt(E.id), b = b.filter(function(e) {
                        return e.id != t
                    }), S.refetchEvents(), L.hide()
                }), x.addEventListener("hidden.bs.offcanvas", function() {
                    F()
                }), T.addEventListener("click", e => {
                    a && (a.innerHTML = "Add Schedule"), l.innerHTML = "Add", l.classList.remove(
                        "btn-update-event"), l.classList.add("btn-add-event"), i.classList.add(
                        "d-none"), t.classList.remove("show"), n.classList.remove("show")
                }), p && p.addEventListener("click", e => {
                    e.currentTarget.checked ? document.querySelectorAll(".input-filter").forEach(e => e
                        .checked = 1) : document.querySelectorAll(".input-filter").forEach(e => e
                        .checked = 0), S.refetchEvents()
                }), M && M.forEach(e => {
                    e.addEventListener("click", () => {
                        document.querySelectorAll(".input-filter:checked").length < document
                            .querySelectorAll(".input-filter").length ? p.checked = !1 : p
                            .checked = !0, S.refetchEvents()
                    })
                }), e.config.onChange.push(function(e) {
                    S.changeView(S.view.type, moment(e[0]).format("YYYY-MM-DD")), I(), t.classList.remove(
                        "show"), n.classList.remove("show")
                })
            }
        });
    </script>
@endpush
