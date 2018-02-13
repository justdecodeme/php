let isTypingEnabled, totalTyped, time, totalErrors, totalSuccesses, grossWPM, netWPM, countdown;
// string to be typed
const str = "this is a simple paragraph that is meant to be nice and easy to type which is why there will be mommas no periods or any capital letters so i guess this means that it cannot really be considered a paragraph but just a series of run on sentences this should help you get faster at typing as im trying not to use too many difficult words in it although i think that i might start making it hard by including some more difficult letters I'm typing pretty quickly so forgive me for any mistakes i think that i will not just tell you a story about the time i went to the zoo and found a monkey and a fox playing together they were so cute and i think that they were not supposed to be in the same cage but they somehow were and i loved watching them horse around forgive the pun well i hope that it has been highly enjoyable typing this paragraph and i wish you the best of luck getting the best score that you possibly can.";
// convert string to array
const strArr = str.split('');
const timerArea = document.querySelector('#timerArea');
const timerDisplay = document.querySelector('.display__time-left');
const typingArea = document.querySelector('#typingArea');
const toggleTypingBtn = document.querySelector('#toggleTypingBtn');
const seekBar = document.querySelector('#seekBar');

const totalErrorsEl = document.querySelector('#totalErrors');
const totalTypedEl = document.querySelector('#totalTyped');
const grossWPMEl = document.querySelector('#grossWPM');
const netWPMEl = document.querySelector('#netWPM');
const accuracyEl = document.querySelector('#accuracy');

// FUNCTIONS
var generateText = function() {
  initialTime = 5;
  totalErrors = 0;
  totalSuccesses = 0;
  totalTyped = 0;
  grossWPM = 0;
  netWPM = 0;
  accuracy = 0;
  let strHTML = '';
  isTypingEnabled = false;
  // to show correct
  displayTimeLeft(initialTime);
  // convert string array to html
  strArr.forEach(letter => {
    strHTML += `<span class="letter">${letter}</span>`
  })
  // put generated html into its container {1}
  typingArea.innerHTML = strHTML;
  // select all letters
  let letters = document.querySelectorAll('#typingArea span');
  // select last letter
  let last = document.querySelectorAll('#typingArea span')[str.length-1];
  // add active class to firt letter
  letters[0].classList.add('active');
};

var displayTimeLeft = function(seconds) {
  seekBar.style.width = ((initialTime - seconds) / initialTime) * 100 + '%';

  const minutes = Math.floor(seconds / 60);
  const remainderSeconds = seconds % 60;
  const display = `${minutes}:${remainderSeconds < 10 ? '0' : '' }${remainderSeconds}`;
  timerDisplay.textContent = display;

  // if time ends
  if(seconds == 0) {
  }
}
var timer = function(seconds) {
  // clear any existing timers
  clearInterval(countdown);

  const now = Date.now();
  const then = now + seconds * 1000;
  displayTimeLeft(seconds);

  countdown = setInterval(() => {
    const secondsLeft = Math.round((then - Date.now()) / 1000);
    // check if we should stop it!
    if(secondsLeft < 0) {
      clearInterval(countdown);

      setTimeout(function() {
        // Gross WPM = (total typed / 5) / (time taken in mins)
        grossWPM = (totalTyped/5) / (initialTime/60);

        // Net WPM = Gross WPM - ((total wrong letters typed / 5) / time taken in mins)
        netWPM = grossWPM - ((totalErrors/5) / (initialTime/60));
        // netWPM = ((totalTyped/5) - (totalErrors/5)) / (initialTime/60); // same as above

        accuracy = totalTyped != 0 ? ((totalSuccesses)/totalTyped) * 100 + '%' : 0 + '%';
        // accuracy = ((netWPM)/grossWPM)*100 + '%'; // same as above

        // alert('Done, Check Console Tab!');
        totalErrorsEl.innerHTML = totalErrors;
        totalTypedEl.innerHTML = totalTyped;
        grossWPMEl.innerHTML = Math.round(grossWPM);
        netWPMEl.innerHTML = Math.round(netWPM);
        accuracyEl.innerHTML = parseInt(accuracy);
      });
      // generateText();
      // toggleTypingBtn.classList.remove('active');
      // toggleTypingBtn.innerHTML = 'Start Typing Again';
      // document.removeEventListener('keyup', checkTyping, false);

      return;
    }
    // display it
    displayTimeLeft(secondsLeft);
  }, 1000);
}

var checkTyping = function(e) {
  // select active letter
  let active = document.querySelector('#typingArea span.active');
  // run only if typing is enabled
  if(isTypingEnabled) {
    // check if we didn't reached last letter
    if(totalTyped < str.length-1) {
      totalTyped++;
      // add typed class to current element
      active.classList.add('typed');
      // add active class to next element
      active.nextSibling.classList.add('active');
      // if active letter is equal to typed letter
      if(active.innerHTML == e.key) {
          totalSuccesses++;
          active.classList.add('success');
          active.classList.remove('active');
          // if active letter is not equal to typed letter
      } else if(active.innerHTML != e.key) {
          totalErrors++;
          active.classList.add('error');
          active.classList.remove('active');
      }
      // if we reached last letter
    } else {
      active.classList.remove('active');
      if(active.innerHTML == e.key) {
          totalSuccesses++;
          active.classList.add('success');
      } else if(active.innerHTML != e.key) {
          totalErrors++;
          active.classList.add('error');
      }
      setTimeout(function(){
        alert("DONE!");
      });
      generateText();
      toggleTypingBtn.classList.remove('active');
      toggleTypingBtn.innerHTML = 'Start Typing Again';
      document.removeEventListener('keyup', checkTyping, false);
    }
  }
}
var startTyping = function() {
  timer(initialTime);
  toggleTypingBtn.classList.add('active');
  toggleTypingBtn.innerHTML = 'Stop Typing';
  document.addEventListener('keyup', checkTyping, false);
}
var stopTyping = function() {
  clearInterval(countdown);
  toggleTypingBtn.classList.remove('active');
  toggleTypingBtn.innerHTML = 'Start Typing';
  document.removeEventListener('keyup', checkTyping, false);
}
var toggleTyping = function(e) {
  // check if button is really clicked
  if(e.detail == 1) {
    // if typing is not enabled
    if(!isTypingEnabled) {
      startTyping();
      // if typing is enabled
    } else {
      stopTyping();
    }
    // toggle Typing
    isTypingEnabled = !isTypingEnabled;
  }
}

// EVENT LISTENERS
generateText();
toggleTypingBtn.addEventListener('click', toggleTyping, false);
toggleTypingBtn.click();
