import Calendarify from "./main"

document.querySelector<HTMLDivElement>("#app")!.innerHTML = `
  <input type="text" class="calendarify-input" />
  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
`

const calendarify = new Calendarify('.calendarify-input', {
  onChange: (calendarify) => console.log(calendarify), // You can trigger whatever function in this property (e.g. to fetch data with passed date parameter)
  quickActions: true, // You can enable/disable quick action (Today, Tomorrow, In 2 Days) buttons with boolean
  isDark: false, // You can enable/disable dark mode
  zIndex: 9999,
  customClass: ['font-poppins'], // You can add custom class to the calendarify element
  locale: { // You can set locale for calendar
    format: "DD-MM-YYYY", // Set Custom Format with Moment JS
    lang: {
      code: 'id', // Set country code (e.g. "en", "id", etc)
      months: ["January","February","March","April","May","June","July","August","September","October","November","December"], 
      weekdays: ["Monday","Tuesday","Wednesday","Thusday","Friday","Saturday","Sunday"], // Or you can use locale moment.weekdays instead
    }
  }
})

calendarify.init()
