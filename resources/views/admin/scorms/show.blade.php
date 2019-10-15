<!doctype html>
<html lang=en>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
//     function Scorm_API_12() {
//         var Initialized = false;
//
//         this.LMSInitialize = function(param) {
//             errorCode = "0";
//             if (param == "") {
//                 if (!Initialized) {
//                     Initialized = true;
//                     errorCode = "0";
//                     return "true";
//                 } else {
//                     errorCode = "101";
//                 }
//             } else {
//                 errorCode = "201";
//             }
//             return "false";
//         }
//         // some more functions, omitted.
//     }
//
// var API = new Scorm_API_12();
var API = {};

        (function ($) {
            $(document).ready(setupScormApi());
            function setupScormApi() {
                API.LMSInitialize = LMSInitialize;
                API.LMSGetValue = LMSGetValue;
                API.LMSSetValue = LMSSetValue;
                API.LMSCommit = LMSCommit;
                API.LMSFinish = LMSFinish;
                API.LMSGetLastError = LMSGetLastError;
                API.LMSGetDiagnostic = LMSGetDiagnostic;
                API.LMSGetErrorString = LMSGetErrorString;
            }
            function LMSInitialize(initializeInput) {
                displayLog("LMSInitialize: " + initializeInput);
                return true;
            }
            function LMSGetValue(varname) {
                displayLog("LMSGetValue: " + varname);
                return "";
            }
            function LMSSetValue(varname, varvalue) {
                displayLog("LMSSetValue: " + varname + "=" + varvalue);
                return "";
            }
            function LMSCommit(commitInput) {
                displayLog("LMSCommit: " + commitInput);
                return true;
            }
            function LMSFinish(finishInput) {
                displayLog("LMSFinish: " + finishInput);
                return true;
            }
            function LMSGetLastError() {
                displayLog("LMSGetLastError: ");
                return 0;
            }
            function LMSGetDiagnostic(errorCode) {
                displayLog("LMSGetDiagnostic: " + errorCode);
                return "";
            }
            function LMSGetErrorString(errorCode) {
                displayLog("LMSGetErrorString: " + errorCode);
                return "";
            }
            function displayLog(textToDisplay){
                var loggerWindow = document.getElementById("logDisplay");
                var item = document.createElement("div");
                item.innerText = textToDisplay;
                loggerWindow.appendChild(item);
            }
        })(jQuery);
        window.open("{{ asset('uploads/'.$scorm.'/'.$link) }}", "_self","resizable,scrollbars,status");
    </script>
    <div id="logDisplay">
    </div>
</html>
