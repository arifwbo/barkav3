<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<script type="text/javascript">
  $( document ).ready(function() {
    var values = get_values();
    if (values['academic_year_id'] && values['class_group_id']) {
      get_students();
    }
  });

  function get_values() {
    var values = {
      academic_year_id: $('#academic_year_id').val(),
      class_group_id: $('#class_group_id').val()
    };
    return values;
  }

  function get_students() {
    const values = get_values();
    if (values['academic_year_id'] && values['class_group_id']) {
      _H.Loading(true);
      $.post( _BASE_URL + 'public/student_directory/get_students', values, function( response ) {
        _H.Loading(false);
        const res = response;
        const rows = res.rows;
        let html = '';
        let no = parseInt($('.number:last').text()) + 1;
        for (var z in rows) {
          const row = rows[ z ];
          const template = `
          <div class="profile-student group animate-fade-in">
            <div class="flex flex-col items-center text-center space-y-4">
              <div class="relative">
                <img src="${row.photo}" class="w-24 h-24 lg:w-32 lg:h-32 object-cover rounded-full border-4 border-white shadow-lg group-hover:scale-105 transition-transform duration-300" loading="lazy">
                <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-gradient-to-r from-primary-color to-accent-color rounded-full flex items-center justify-center">
                  <i class="fa fa-graduation-cap text-white text-sm"></i>
                </div>
              </div>
              <div class="space-y-3 w-full">
                <h3 class="font-bold text-lg text-primary-color">${row.full_name}</h3>
                <dl class="grid grid-cols-1 gap-2 text-sm">
                  <div class="bg-gray-50 p-3 rounded-lg">
                    <dt class="text-muted text-xs uppercase tracking-wide">${_IDENTITY_NUMBER}</dt>
                    <dd class="font-medium text-gray-800">${row.identity_number}</dd>
                  </div>
                  <div class="bg-gray-50 p-3 rounded-lg">
                    <dt class="text-muted text-xs uppercase tracking-wide">Jenis Kelamin</dt>
                    <dd class="font-medium text-gray-800">${row.gender}</dd>
                  </div>
                  <div class="bg-gray-50 p-3 rounded-lg">
                    <dt class="text-muted text-xs uppercase tracking-wide">Tempat, Tanggal Lahir</dt>
                    <dd class="font-medium text-gray-800">${row.birth_place}, ${row.birth_date}</dd>
                  </div>
                </dl>
              </div>
            </div>
          </div>
          `;
          html += template;
        }
        const elementId = $(".student-directory");
        $(elementId).html(html);
      });
    }
  }
  </script>
<main class="container space-y-5 my-5 flex-1">
  <div class="space-y-4">
    <h3 class="font-heading text-2xl font-black text-title"><span class="fa fa-student"></span> <?= ucwords($page_title) ?></h3>
    <form onsubmit="return false;" class="mb-3">
      <div class="grid gap-4 lg:grid-cols-3 items-center lg:w-3/4">
        <div class="w-full">
          <label class="mr-sm-2 sr-only" for="academic_year_id"><?= __session('_academic_year') ?></label>
          <?= form_dropdown('academic_year_id', $academic_years, __session('current_academic_year_id'), 'class="form-select w-full" id="academic_year_id"') ?>
        </div>
        <div class="w-full">
          <label class="mr-sm-2 sr-only" for="class_group_id">Kelas</label>
          <?= form_dropdown('class_group_id', $class_groups, '', 'class="form-select w-full" id="class_group_id"') ?>
        </div>
        <div class="w-full">
          <button type="button" onclick="get_students()" class="btn">
            <i class="fa fa-search"></i> 
            <span>CARI SISWA</span>
          </button>
        </div>
      </div>
    </form>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 student-directory animate-fade-in"></div>
    <div class="loading-area"></div>
  </div>
</main>
