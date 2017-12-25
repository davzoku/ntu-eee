// insert_names.js 
//   The script in this document has an array of
//   names, name_list, whose values are in 
//   alphabetic order. New names are input through
//   prompt. Each new name is inserted into the 
//   name array, after which the new list is 
//   displayed.

// The original list of names

      var name_list = new Array("Al", "Betty", "Kasper",
                         "Michael", "Roberto", "Zimbo");
      var new_name, index, last;

// Loop to get a new name and insert it

      while (new_name = 
                prompt("Please type a new name", "")) {

// Loop to find the place for the new name

        last = name_list.length - 1;
   
        while (last >= 0 && name_list[last] > new_name) { 
          name_list[last + 1] = name_list[last];
          last--;
        }

// Insert the new name into its spot in the array

        name_list[last + 1] = new_name;

// Display the new array

        document.write("<p><b>The new name list is:</b> ",
                       "<br />");
        for (index = 0; index < name_list.length; index++)
          document.write(name_list[index], "<br />");
        document.write("</p>");
      } //** end of the outer while loop
