export let timeAgo = (date) => {
  var ms = new Date().getTime() - date.getTime();
  var seconds = Math.floor(ms / 1000);
  var minutes = Math.floor(seconds / 60);
  var hours = Math.floor(minutes / 60);
  var days = Math.floor(hours / 24);
  const weeks = Math.floor(days / 7);
  var months = Math.floor(weeks / 4);
  var years = Math.floor(months / 12);

  // --------------------- i modified this condition and commented out the original block of code below it -------------
  if (ms === 0 || seconds < 60) {
    return 'Just now';
  }
  // if (seconds < 60) {
  //   return seconds + ' seconds Ago';
  // }
  if (minutes < 60) {
    return minutes + (minutes > 1 ? 'mins' : 'min');
  }
  if (hours < 24) {
    return hours + (hours > 1 ? 'hrs' : 'hr');
  }
  if (days < 7) {
    return days + (days > 1 ? 'days' : 'day');
  }
  if (weeks < 4) {
    return weeks + (weeks > 1 ? 'weeks' : 'week');
  }
  if (months < 12) {
    return months + (months > 1 ? 'months' : 'month');
  } else {
    return years + (years > 1 ? 'yrs' : 'yr');
  }
};
