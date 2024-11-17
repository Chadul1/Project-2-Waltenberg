import {setCookie, getCookie} from "./JSLibrary.js";

//grabs the text node elements for populating.
const textElement = document.getElementById('text');
const optionButtonsElement = document.getElementById('option-buttons');


//Starts the game.
function startGame() {
    var startState = 101;
    //sets a save cookie.
    setCookie("gameState", startState, 7);
    displayTextNode(startState);
}

//displays the text found within the array and adds option buttons.
function displayTextNode(textNodeIndex) {
    //finds the next text node. 
    const textNode = textNodes.find(textNode => textNode.id == textNodeIndex);
    textElement.innerText = textNode.text;
    //removes the old text options.
    while(optionButtonsElement.firstChild) {
        optionButtonsElement.removeChild(optionButtonsElement.firstChild);
    } 

    //adds the buttons.
    textNode.options.forEach(option => {
        const div = document.createElement('div');
        div.className = "col-md-6 mb-4";

        const button = document.createElement('button');
        button.innerText = option.text;
        button.className = "btn btn-secondary w-100";
        button.addEventListener('click', () => selectOption(option));
        div.appendChild(button);
        optionButtonsElement.appendChild(div);
    });
}

//Selects the next option and resets to the start when an ending is called. 
function selectOption(option) {

    const nextTextNodeId = option.nextText;
    //resets the game when handled.
    if (nextTextNodeId <= 0) {
        startGame();
    }
    setCookie("gameState", nextTextNodeId, 7);
    displayTextNode(nextTextNodeId);
}

//saves the game
function saveGame() {

    //gets the save state cookie and sets it.
    var id = getCookie("gameState");
    setTimeout(function() {
        document.getElementById('save').textContent = "SAVED!"
        setTimeout(function(){
            document.getElementById('save').textContent = "Save"
        },2000);
    }, 100);

    setCookie("gameSave", id, 7);
}

//loads the admin game
function adminGame() {
    //gets the player save and loads it.
    var id = getCookie("gameSave");
    setTimeout(function() {
        document.getElementById('load').textContent = "LOADED!"
        setTimeout(function(){
            document.getElementById('load').textContent = "Load"
        },2000);
    }, 100);
    displayTextNode(id);
}

//The function that loads the game
function loadGame() {
    //gets the save and loads it.
    var id = getCookie("gameSave");
    setTimeout(function() {
        document.getElementById('load').textContent = "LOADED!"
        setTimeout(function(){
            document.getElementById('load').textContent = "Load"
        },2000);
    }, 100);
    displayTextNode(id);
}

//listens for the buttons to be clicked.
document.getElementById('save').addEventListener('click', saveGame);
document.getElementById('load').addEventListener('click', loadGame);
if(document.getElementById('AdminLoad')){
    document.getElementById('AdminLoad').addEventListener('click', adminGame);
}



//The story.
const textNodes = [
    {
        id:101,
        text: "After eating a particularly bad slice of week old pizza. A low rumbling in your gut tells you to sleep in your old fallout bunker for the night. \n You decide to indulge this impulse and you sleep soundly beneath a blanket you are certain is four times older than you are. \n \n You wake up and learn that the worst has happened. Nuclear fire has engulfed the world and as far as you know, you are the last human on Earth.",
        options: [
            {
                text: "Start the Game",
                nextText: 102
            }
        ]
    },
    {
        id:102,
        text: "??? - \"Hey, you.\" ",
        options: [
            {
                text: "\"What?\"",
                nextText: 103
            }
        ]
    },
    {
        id:103,
        text: "Gut - \"You aren't going to believe this. But It's your gut speaking, You should listen to me from here on out considering I saved your butt from burning up like the rest of them.\"",
        options: [
            {
                text: "\"This must be one of those traumatic breaks that happen in extremely stressful scenarios.\"",
                nextText: 201
            },
            {
                text: "\"Excuse Me?\"",
                nextText: 104
            }
        ]
    },
    {
        id:104,
        text: "Gut - \"I am your Gut, listen to me okay?\"",
        options: [
            {
                text: "\"Oh sure, that makes sense.\"",
                nextText: 301
            },
            {
                text: "\"What. Huh? What is happening? What is this? Who are you?\"",
                nextText: 105
            }
        ]
    },
    {
        id:105,
        text: "Gut - \"I. Am. Your. Stomach. Listen to me if you want to live. \" Your gut rumbles in annoyance at your inability to accept your new reality.",
        options: [
            {
                text: "\"Oh sure, that makes sense. Sorry. Whoops.\"",
                nextText: 301
            },
            {
                text: "\"What? I don't get it. Could you give it to me again? This is crazy.\"",
                nextText: 106
            }
        ]
    },
    {
        id:106,
        text: "You stood in a bunker for nineteen hours, fourteen minutes, and eighty-eight seconds as you asked question after question that usually both started with \"what?\" and \"huh?\". \n Soon your stomach grew quiet as you failed to establish a baseline of reality. You were left alone with no guiding voice and died of starvation in the bunker. \n \n You got the \"Socratic Moron Ending\"",
        options: [
            {
                text: "\"Start Over?\"",
                nextText: -1
            }
        ]
    },
    {
        id:201,
        text: "Gut - \"Nope, this is the \*Real deal\*. We're survivors. Like Alexander the Great and Lief Ericson. True Morcathnogathic Legends. We don't have \*traumatic breaks\* and \*Post Trauatic Stress Disorders\*. We \*walk that shit off\*. We walk off the divorce, We walk off our boss riding our ass and now we're going to walk off the apocalypse like men.\"",
        options: [
            {
                text: "\"I don't think I mentioned any of those other things.\"",
                nextText: 202
            },
            {
                text: "\"Oh okay. I guess I'll man up now.\"",
                nextText: 301
            }
        ]
    },
    {
        id:202,
        text: "Gut - \"Listen man, come closer.\" Your gut growls. \"Hear that? I am hungry, we can't be thinking about this stuff like *the divorce* and *the boss*. Stop thinking about those *boring* things and start thinking about your next meal.\"",
        options: [
            {
                text: "\"That's a very good point, I feel silly for questioning you. This is my new reality after all.\"",
                nextText: 301
            },
            {
                text: "\"Nope, I want off this wild ride.\"",
                nextText: 203
            }
        ]
    },
    {
        id:203,
        text: "You waste away as your grow hungrier and hungrier. You got so hungry that you eventually think about eating your shoes. So hungry that you sit down and stop moving forever. You died because you didn't listen to your gut. \n \n You got the \"Gutless Survivor Ending\".",
        options: [
            {
                text: "\"Start Over?\"",
                nextText: -1
            }
        ]
    },
    {
        id:301,
        text: "Gut - \"That's the spirit, now listen, your first goal should be food. It keeps me alive so I can keep you alive. By the looks of things, you never stocked this place with anything beyond a single can of peaches. We should probably find some kind of source of food.\"",
        options: [
            {
                text: "\"Makes sense. What should we do?.\"",
                nextText: 302
            }
        ]
    },
    {
        id:302,
        text: "You feel a vile guggling rising up through your stomach as a new contender enters the rings. \n \n Appendix - \"Do not listen to this imposter organ, this \"Gut\" will be the end of you.\" \n \n Gut - \"Ignore this guy, he's a few cards short of a deck.\"",
        options: [
            {
                text: "\"What do you mean? This Gut guy hasn't done me wrong yet.\"",
                nextText: 303
            },
            {
                text: "\"Go on.\"",
                nextText: 304
            }
        ]
    },
    {
        id:303,
        text: "Appendix - \"The \"Gut\" is a mad demon who ended the world. You shouldn't listen to such a vile creature. It is literally worse than Hitler.\" \n \n Gut - \"I don't even have hands. How would I launch Nukes?\"",
        options: [
            {
                text: "\"Whoa, Yeah, Gut. What the hell man? That's it, no more trusting you ever.\"",
                nextText: 401
            },
            {
                text: "\"Good Point Gut, Appendix, Shush. Let the men talk.\"",
                nextText: 501
            }
        ]
    },
    {
        id:304,
        text: "Appendix - \"Ragnarǫk. The Seven Seals. The Sun and the End. All of these are all guttural events bound to all men. The Gut caused this, because all the guts of men are connected. This was his doing. This isn't science, this is truth. Are you really going to deny the truth?\" \n \n Gut - \"Guts don't have psychic bonds, they have bacteria that converts food into energy.\" ",
        options: [
            {
                text: "\"I dunno Gut, you do sound mighty suspicious denying the \"Truth\". I'm going to go with this Appendix guy.\"",
                nextText: 401
            },
            {
                text: "\"Appendix. You gotta gimme some sources on that. Otherwise, I'm listening to Gut here.\"",
                nextText: 501
            }
        ]
    },
    {
        id:401,
        text: "Gut - \"Are you actually believing that moron?\" \n\n Appendix - \"Silence! I am Förstöraren. His lordship has chosen to heed my words. Back! Back to the pit!\" \n\n Your stomach growls and goes silent. \n Appendix - \"Anyway, where were we?\"  ",
        options: [
            {
                text: "\"Starving?\"",
                nextText: 402
            }
        ]
    },
    {
        id:402,
        text: "Appendix - \"Oh yes! You did store a \"Weapon\". The Weapon can be used to strike down unholy deamons bound in deer flesh. Step into your wild side as god intended us to be. Devour the heart of deamons and gain their power. Popoca.\" ",
        options: [
            {
                text: "\"Great Idea Appendix. Deamon flesh, here I come.\"",
                nextText: 403
            },
            {
                text: "\"Uh. Wow. That's a bit much. But I guess I could brush up on my hunting.\"",
                nextText: 403
            }
        ]
    },
    {
        id:403,
        text: "Using \"The Weapon\", You hunt for the rest of your days and become a fierce weapon of your Appendix. As a result, the stomach goes ignored. You feel unfulfilled and restless as you steadily forget your humanity and become like that of the animals. Bathing in the blood of the animals you hunt, you steadily gain their strength. But you lose what made you human bit by bit. Soon, Your mind grows simple as you focus all of your attention upon the gathering of pelts, cooking food, and hunting prey. Only the remaining ruins around you spark any memory of the times before. \n \n You got the \"Animal\" Ending.",
        options: [
            {
                text: "\"Start Over.\"",
                nextText: -1
            }
        ]
    },
    {
        id:501,
        text: "Appendix - \"Don't deny the Truth\" \n\n Gut - \"Silence. Return from whence you came.\" \n\n And with a gurgle, whatever influence it had upon you passed",
        options: [
            {
                text: "\"That was great and all. But I'm still starving.\"",
                nextText: 502
            }
        ]
    },
    {
        id:502,
        text: "Gut - \"Then let us not waste another moment. There was a grocery store not far from this bunker. Since everyone is dead, there won't be much competition for food. But that is a decision for you. YOU are the master and I am a humble energy factory.\"",
        options: [
            {
                text: "\"That's a surprisingly simple solution.\"",
                nextText: 503
            }
        ]
    },
    {
        id:503,
        text: "You walk to the food-mart and enter the building. you pass skeletons by and find a mountain of canned food before you. you spend the next three days bringing any nonperishable food to your bunker. With water from a well and food, heat and shelter in the bunker. Your stomach is satisfied and goes quiet. \n \n You got the \"Astute Survivor\" Ending;",
        options: [
            {
                text: "\"Start Over.\"",
                nextText: -1
            }
        ]
    },
];

//Starts the game.
startGame();