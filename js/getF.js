function getFlagImage(language) {
    // Define a map of language names to flag image directories
    const languageFlags = {
        "French": "france.png",
        "German": "germanyy.png",
        "English": "united-states.png",
        "Arabic":"flag.png",
        // Add more language-flag mappings as needed
    };

    // Check if the provided language is in the map
    if (language in languageFlags) {
        // Return the corresponding flag image directory
        return "images/" + languageFlags[language];
    } else {
        // If the language is not found, return a default flag image
        return "images/default-flag.png";
    }
}