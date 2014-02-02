$(function()
  {
    
    $('#add').on('click', function(e)
    {
      var name = $("#name").val();
      var surname = $("#surname").val();
      var faculty = $("#faculty").val();
      var course = $("#course").val();

      var newhtml = '';
      e.preventDefault();
      
      $.ajax(
      {
        url: 'php/update.php',
        type: 'post',
        data: {'add': true, 'Name': name, 'Surname': surname, 'Course': course, 'Faculty': faculty},
        success: function(data)
        {
          var index = jQuery.parseJSON( data );
          newhtml += '<tr><td>'+index+'</td><td>'+name+'</td><td>'+surname+'</td><td>'+course+'</td><td>'+faculty+'</td></tr>';
          $('table').append(newhtml);
        }
      })
    });

    $('#edit').on('click', function(e)
    {
      var name = $("#name").val();
      var surname = $("#surname").val();
      var faculty = $("#faculty").val();
      var course = $("#course").val();
      var index = $("#index").val();

      e.preventDefault();
      
      var newhtml = $('tbody').html();
      var rows = newhtml.split('</tr>');
      if (index>rows.length-1) return;
      $.ajax(
      {
        url: 'php/update.php',
        type: 'post',
        data: {'edit': true, 'Name': name, 'Surname': surname, 'Course': course, 'Faculty': faculty, 'Index': index},
        success: function()
        {
          jQuery.each(rows, function() 
          {
            rows[index-1] = '<tr><td>'+index+'</td><td>'+name+'</td><td>'+surname+'</td><td>'+course+'</td><td>'+faculty+'</td></tr>';
          })
          $('tbody').html(rows);
        }
      })
    })

    $('#delete').on('click', function(e)
    {
      var index = $("#index").val();

      e.preventDefault();
      
      var newhtml = $('tbody').html();
      var rows = newhtml.split('</tr>');
      rows[rows.length-1]='';
      if (index>rows.length-1) return;

      $.ajax(
      {
        url: 'php/update.php',
        type: 'post',
        data: {'delete': true,'Index': index},
        success: function()
        {
          for (var i = 0; i < rows.length; i++) 
          {
            rows[i] += '</tr>';
            if (i == index-1) 
              {
                for (var t = i; t < rows.length-1; t++)
                rows[t]=rows[t+1];
              }
            if (i >= index-1 && i < rows.length-2) 
            {
              var len=0;
              var p=0;
              var field = rows[i];
              while (len == false)
              {
                if (field.charAt(p) == '/')
                {
                  len=p;
                }
                p++;
              }
              rows[i] = '<tr><td>' + (i+1) + field.substr(len-1);
            }
          }
          $('tbody').html(rows);
        }
      })
    })

    $('#enter').on('click', function(e)
    {
      var login = $("#login").val();
      var pass = $("#pass").val();
      
      e.preventDefault();
      $.ajax(
      {
        url: 'php/session.php',
        type: 'post',
        data: {'enter': true,'Login': login, 'Pass': pass},
        success: function(data)
        {
          location.reload();
        }
      })
    });

    $('#exit').on('click', function(e)
    {
      e.preventDefault();
      $.ajax(
      {
        url: 'php/session.php',
        type: 'post',
        data: {'exit': true},
        success: function(data)
        {
          location.reload();
        }
      })
    });
  });
  
